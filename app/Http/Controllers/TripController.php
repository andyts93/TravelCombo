<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Airport;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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
        return view('trip.create');
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
            return redirect()->back()->with('error', 'An error occurred, please try again');
        }

        return redirect(route('trip.edit', $trip));
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        $matrix = new \Illuminate\Support\Collection();

        $min = [];

        foreach ($trip->outboundFlights as $flight) {
            foreach ($trip->accomodations as $accomodation) {
                $response = Cache::rememberForever($flight->id . $accomodation->id, function() use ($flight, $accomodation) {
                    $response = Http::get('https://router.project-osrm.org/route/v1/car/' . $flight->airportTo->longitude . ',' . $flight->airportTo->latitude . ';' . $accomodation->longitude . ',' . $accomodation->latitude);
                    return json_decode($response->body());
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
                $matrix->push((object)[
                    'flight' => $flight,
                    'accomodation' => $accomodation,
                    'distance' => $response->routes[0]->distance,
                    'duration' => $response->routes[0]->duration,
                    'price' => $flight->price + $accomodation->price,
                    'check_in_gap' => $flight->date_to->clone()->utc()->longRelativeDiffForHumans(
                        Carbon::parse($accomodation->date_from->setTimeFromTimeString($accomodation->check_in ?? '12:00:00'))
                    ),
                    'check_out_gap' => $flight->linkedFlight->date_from->clone()->utc()->longRelativeDiffForHumans(
                        Carbon::parse($accomodation->date_to->setTimeFromTimeString($accomodation->check_out ?? '09:00:00'))
                    )
                ]);
            }
        }
        // dd($matrix->toArray());

        $matrix = $matrix->map(function($el) use ($min) {
            $el->best_distance = $el->duration === $min['duration'];
            $el->best_price = $el->price === $min['price'];
            return $el;
        });

        return view('trip.show', compact('trip', 'matrix'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        return view('trip.edit', compact('trip'));
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
