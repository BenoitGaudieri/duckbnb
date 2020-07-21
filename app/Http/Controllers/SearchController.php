<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class SearchController extends Controller
{
    public function index()
    {
        return view('guests.search');
    }

    public function search(Request $request)
    {
        $origin = [
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];

        if ($request) {
            $ids = $request->id[0];
            $array = explode(',', $ids);

            $apartments = Apartment::all()->whereIn("id", $array);
            return view('guests.search', compact("apartments", 'origin'));
        } else {
            return view("guest.search");
        }
    }
}
