<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function search(Request $request)
    {
        $apartments = Apartment::all();

        // $data = $request->all();
        // $filter = $data["filter"];
        // $filter = $request->filter;
        $filter = $request->input("filter");
        $array = explode(', ', $filter);

        $apartments = Apartment::all()->whereIn("id", $array);

        return response()->json($apartments);
    }
}
