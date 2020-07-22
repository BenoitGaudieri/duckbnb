<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
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

        if($request->services <> 'all') {
            $services = explode(',', $request->services);
        } else {
            $services = 'all';
        }

        $apartments = Apartment::with('services')
                    ->whereIn('id', $ids)
                    ->where([
                        ['room_qty', '>=', $minRooms],
                        ['bed_qty', '>=', $minBeds],
                        ['is_visible', '=', 1]
                    ])
                    ->get();

        $res = [
            'error' => '',
            'response' => []
        ];

        
        if( $apartments->isNotEmpty() ) {
            foreach ($apartments as $apartment) {
                // Compiling array with apartment's service ids
                $array = [];
                foreach ($apartment->services as $service) {
                    $array[] = $service['id'];
                }

                if($services == 'all') {
                    $res['response'][] = $apartment;
                } elseif(count($services) <= count($array)) {
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
