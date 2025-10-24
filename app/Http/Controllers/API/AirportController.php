<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(Request $request)
    {
        $airports = Airport::query()
            ->when($request->input('q'), function ($qb) use ($request) {
                $qb->where('name', 'like', '%' . $request->input('q') . '%')
                    ->orWhere('iata_code', 'like', '%' . $request->input('q') . '%')
                    ->orWhere('municipality', 'like', '%' . $request->input('q') . '%');
            })
            ->limit(25)
            ->get();

        return response()->json($airports->map(function($el) {
            $el->name = $el->name . " ($el->iata_code)";
            return $el;
        }));
    }
}
