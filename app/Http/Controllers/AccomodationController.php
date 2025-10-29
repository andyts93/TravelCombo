<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccomodationRequest;
use App\Models\Accomodation;
use App\Services\TimeZoneService;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function store(AccomodationRequest $request)
    {
        $data = $request->validated();

        try {
            $data['timezone'] = TimeZoneService::getTimezone($data['latitude'], $data['longitude'])?->zoneName;
            Accomodation::query()->create($data);
        } catch (\Exception $exception) {
            return redirect()->back()->with('accomodation-error', 'An error occurred, please try again.')->withInput();
        }

        return redirect()->back();
    }
}
