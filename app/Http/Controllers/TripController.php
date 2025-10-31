<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Airport;
use App\Models\Country;
use App\Models\Trip;
use App\Services\NagerDateService;
use App\Services\NominatimService;
use App\Services\OpenAqService;
use App\Services\OpenMeteoService;
use App\Services\OverpassService;
use App\Services\ProjectOsrmService;
use App\Services\UnsplashService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Ramsey\Collection\Collection;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::query()->orderBy('name')->get();
        return view('trip.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $request)
    {
        $data = $request->validated();

        try {
            $trip = Trip::query()->create($data);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An error occurred, please try again')->withInput();
        }

        return redirect(route('trip.edit', $trip));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Trip $trip,
        ProjectOsrmService $osrmService,
        NominatimService $nominatimService,
        OverpassService $overpassService,
        OpenMeteoService $meteoService,
        UnsplashService $unsplashService,
        NagerDateService $nagerDateService
    )
    {
        $matrix = new \Illuminate\Support\Collection();

        $min = [];

        foreach ($trip->outboundFlights as $flight) {
            foreach ($trip->accomodations as $accomodation) {
                $response = Cache::rememberForever($flight->id . $accomodation->id, function() use ($flight, $accomodation) {
                    $response = Http::get('https://router.project-osrm.org/route/v1/car/' . $flight->airportTo->longitude . ',' . $flight->airportTo->latitude . ';' . $accomodation->longitude . ',' . $accomodation->latitude);
                    return json_decode($response->body());
                });

//                Cache::forget('attractions_' . $accomodation->id);
                $attractions = Cache::rememberForever('attractions_' . $accomodation->id, function() use ($accomodation, $overpassService) {
                   return $overpassService->searchNearbyPOIs($accomodation->latitude, $accomodation->longitude, 500);
                });

                $price = $flight->price + $accomodation->price;

                if (!isset($min['duration'])) $min['duration'] = $response->routes[0]->duration;
                if (!isset($min['price'])) $min['price'] = $price;

                if ($response->routes[0]->duration < $min['duration']) {
                    $min['duration'] = $response->routes[0]->duration;
                }
                if ($price < $min['price']) {
                    $min['price'] = $price;
                }

                $checkInGap = max(0, $flight->date_to->clone()->addSeconds($response->routes[0]->duration)->diffInMinutes(
                    $accomodation->date_from
                ));
                $checkOutGap = max(0, $accomodation->date_to->diffInMinutes(
                    $flight->linkedFlight->date_from
                ));
                $matrix->push((object)[
                    'id' => Str::uuid(),
                    'flight' => $flight,
                    'accomodation' => $accomodation,
                    'distance' => $response->routes[0]->distance,
                    'duration' => $response->routes[0]->duration,
                    'price' => $flight->price + $accomodation->price,
                    'check_in_gap' => $checkInGap,
                    'check_out_gap' => $checkOutGap,
                    'homelessness' => $checkInGap + $checkOutGap,
                    'nearby' => collect($attractions)->groupBy(fn($el) => $el['tags']['tourism'] ?? $el['tags']['shop'] ?? $el['tags']['public_transport']),
                ]);
            }
        }

        $matrix = $matrix->groupBy('accomodation.city')->map(function ($combinations) use ($meteoService, $nominatimService, $unsplashService, $osrmService, $min, $nagerDateService) {
            $city = $combinations->first()->accomodation->city;
            $country = $combinations->first()->accomodation->region_code;

            if ($city) {
                $minDate = $combinations->pluck('accomodation')->min('date_from');
                $maxDate = $combinations->pluck('accomodation')->min('date_to');

                $cityCenter = Cache::rememberForever('center-' . $city, function () use ($city, $nominatimService) {
                    return $nominatimService->search($city);
                });

                $combinations = $combinations->map(function ($combination) use ($cityCenter, $osrmService, $min) {
                    $distance = Cache::rememberForever('distance_' . $combination->accomodation->id . '_' . $cityCenter['lat'] . $cityCenter['lon'], function () use ($combination, $cityCenter, $osrmService) {
                        return $osrmService->route('foot', [[$combination->accomodation->longitude, $combination->accomodation->latitude], [$cityCenter['lon'], $cityCenter['lat']]]);
                    });
                    $combination->center_distance = isset($distance) ? $distance['routes'][0]['distance'] : null;
                    $combination->center_duration = isset($distance) ? $distance['routes'][0]['duration'] : null;

                    $combination->best_distance = $combination->duration === $min['duration'];
                    $combination->best_price = $combination->price === $min['price'];

                    return $combination;
                });

                $weather = Cache::rememberForever('weather_' . $city, function () use ($minDate, $maxDate, $cityCenter, $meteoService) {
                    return $meteoService->getHistoricalWeather(
                        $cityCenter['lat'],
                        $cityCenter['lon'],
                        $minDate->clone()->subYear(),
                        $maxDate->clone()->subYear());
                });
//
                $image = Cache::rememberForever('unsplash_' . $city, function () use ($unsplashService, $city) {
                    $photos = $unsplashService->search($city);
                    return collect($photos['results'])->get(rand(0, count($photos['results']) - 1));
                });

                $years = collect([$minDate->year, $maxDate->year])->unique()->values();
                $holidays = Cache::rememberForever('holidays_' . $country . $years->implode('_'), function() use ($nagerDateService, $country, $years) {
                    $result = collect([]);
                    foreach ($years as $year) {
                        $result = $result->merge($nagerDateService->getHolidays($year, $country));
                    }
                    return $result;
                });
                $holidays = $holidays->filter(function($holiday) use ($minDate, $maxDate) {
                    return Carbon::parse($holiday['date'])->between($minDate, $maxDate);
                });
            }

            return (object) [
                'city' => $city,
                'image' => $image ?? null,
                'combinations' => $combinations,
                'weather' => $weather ?? null,
                'holidays' => $holidays ?? [],
            ];

        })->values();

        return view('trip.show', compact('trip', 'matrix'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $airports = Airport::query()->where('country_id', $trip->country_id)->get(['id', 'iata_code', 'name']);
        return view('trip.edit', compact('trip', 'airports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
