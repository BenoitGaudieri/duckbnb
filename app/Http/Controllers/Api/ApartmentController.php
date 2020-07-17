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
        $filter = $request->input("filter");
        $idArr = explode(', ', $filter);

        $apartments = $apartments->whereIn("id", $idArr);

        // if ($request->input("services")) {
        //     $services = $request->input("services");
        //     $servicesArr = explode(', ', $services);
        //     // $apartments = $apartments->whereIn($apartments->services->name, $servicesArr);
        //     $apartments = Apartment::whereHas("services", function ($query) use ($servicesArr) {
        //         $query->whereIn("id", [1]);
        //     });
        // }

        if ($request->input("rooms")) {
            $rooms = $request->input("rooms");
            $roomsArr = explode(', ', $rooms);
            $apartments = $apartments->whereIn("room_qty", $roomsArr);
        }
        if ($request->input("beds")) {
            $beds = $request->input("beds");
            $bedsArr = explode(', ', $beds);
            $apartments = $apartments->whereIn("bathroom_qty", $bedsArr);
        }



        return response()->json($apartments);
    }
}
