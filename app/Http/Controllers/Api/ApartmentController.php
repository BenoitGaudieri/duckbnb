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

        // $apartments = Apartment::all()->whereIn("id", $idArr);
        $apartments = $apartments->whereIn("id", $idArr);

        if ($request->input("rooms")) {
            $rooms = $request->input("rooms");
            $roomsArr = explode(', ', $rooms);
            $apartments = $apartments->whereIn("room_qty", $roomsArr);
        }


        return response()->json($apartments);
    }
}
