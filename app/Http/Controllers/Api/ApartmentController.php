<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
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

    public function filter(Request $request)
    {   
        $ids = explode(',', $request->id);
        $minRooms = $request->rooms;
        $minBeds = $request->beds;
        $services = explode(',', $request->services);

        $apartments = Apartment::with('services')
                    ->whereIn('id', $ids)
                    ->where([
                        ['room_qty', '>=', $minRooms],
                        ['bed_qty', '>=', $minBeds]
                    ])
                    ->get();

        $res = [
            'error' => '',
            'response' => []
        ];

        
        if( $apartments->isNotEmpty() ) {
            foreach ($apartments as $apartment) {
                $array = [];

                foreach ($apartment->services as $service) {
                    $array[] = $service['id'];
                }

                if(count($services) <= count($array)) {
                    if(array_intersect($array, $services)) {
                        $res['response'][] = $apartment;
                    }
                }
                
            }
        } else {
            $res['response'] = 'empty';
        }

        return response()->json($res);
    }
}
