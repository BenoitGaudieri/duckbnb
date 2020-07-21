<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class SearchController extends Controller
{
    public function index()
    {
        $origin = [
            'lat' => '',
            'lng' => '',
        ];

        return view('guests.search', compact('origin'));
    }

    public function search(Request $request)
    {
        $services = Service::all();

        $origin = [
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];

        if ($request) {
            $ids = $request->id[0];
            $array = explode(',', $ids);

            $apartments = Apartment::all()->whereIn("id", $array);
            return view('guests.search', compact("apartments", 'origin', 'services'));
        } else {
            return view("guest.search");
        }
    }
}
