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

        // TODO: services to fix.
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
            $apartments = $apartments->whereIn("room_qty", $rooms);
        }
        if ($request->input("beds")) {
            $beds = $request->input("beds");
            // TODO: 4+ to fix. I hate queries.
            if ($beds == "4+" || $beds > 4) {
                $apartments = $apartments->with("bathroom_qty", ">=", 4);
            } else {
                $apartments = $apartments->whereIn("bathroom_qty", $beds);
            }
        }

        return response()->json($apartments);
    }
}
