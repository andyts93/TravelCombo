<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccomodationRequest;
use App\Models\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function store(AccomodationRequest $request)
    {
        $data = $request->validated();

        try {
            Accomodation::query()->create($data);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->with('accomodation-error', 'An error occurred, please try again.')->withInput();
        }

        return redirect()->back();
    }
}
