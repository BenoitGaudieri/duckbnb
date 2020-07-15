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
        $ids = $request->id[0];
        $array = explode(',', $ids);

        $apartments = Apartment::all()->whereIn("id", $array);


        // for ($i = 0; $i < count($array); $i++) {
        //     $selectedApts = $apartments->with(["id" => $array[$i]])->get();
        // }

        // foreach ($array as $item => $key) {
        //     $apartments[] = Apartment::where('id', $key)->get();
        // }


        return view('guests.search', compact('apartments'));
    }
}
