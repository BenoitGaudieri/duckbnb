<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {   
        $ids = explode(',', $request->id);

        $apartments = Apartment::with('services')->whereIn('id', $ids)->get();

        $res = [
            'error' => '',
            'response' => []
        ];

        foreach ($apartments as $apartment) {
            $res['response'][] = $apartment;
        }

        return response()->json($res);
    }

    public function search(Request $request)
    {
        $id = $request->id;
        
        $apartments = Apartment::with('services')->whereIn('id', $id)->get();
        // $data = $request->all();
        // $filter = $data["filter"];
        // $filter = $request->filter;
        // $filter = $request->input("filter");
        // $array = explode(',', $filter);

        // $apartments = Apartment::all()->whereIn("id", $array);

        return response()->json($apartments);
    }

    public function stats(Apartment $apartment)
    {
        $data = Apartment::with('views')->find($apartment->id);

        $res = [
            'error' => '',
            'response' => $data
        ];

        return response()->json($res);
    }
}
