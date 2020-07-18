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
        $aptServices = Apartment::with("services");

        // $data = $request->all();
        $filter = $request->input("filter");
        $idArr = explode(', ', $filter);

        $apartments = $apartments->whereIn("id", $idArr);

        //
        if ($request->input("services")) {
            $services = $request->input("services");
            // $servicesArr = explode(', ', $services);
            $servicesArr = collect(explode(', ', $services));

            // $apartments = Apartment::with("services")->get();
            $apartments = Apartment::with("services")->where("services.id", "=", "9")->get();
            $apartments = $apartments->find($idArr);
            // $apartments = $apartments->where("id", "=", "9");
        };

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
