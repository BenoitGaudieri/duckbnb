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
        $res = [
            'error' => '',
            'response' => []
        ];

        $ids = explode(',', $request->id);
        $minRooms = $request->rooms;
        $minBeds = $request->beds;
        
        if($request->services <> 'all') {

            $services = explode(',', $request->services);
            $apartments = $this->queryWithServices($ids, $minRooms, $minBeds, $services);
            
            
            if( $apartments->isNotEmpty() ) {
                foreach ($apartments as $apartment) {
                    
                    $array = [];

                    foreach ($apartment->services as $service) {
                        $array[] = $service['id'];
                    }

                    if(count($services) <= count($array)) {
                        $diff = array_diff($services, $array);
                        
                        if(empty($diff)) {
                            $res['response'][] = $apartment;
                        }
                    }
                }
            }
          
        } else {
            $apartments = $this->queryNoServices($ids, $minRooms, $minBeds);

            if($apartments->isNotEmpty()) {
                foreach($apartments as $apartment) {
                    $res['response'][] = $apartment;
                }
            }
        }

        return response()->json($res);
    }

    private function queryWithServices($ids, $minRooms, $minBeds, $services)
    {
        return Apartment::with('services', 'reviews')
            ->whereIn('id', $ids)
            ->where([
                ['room_qty', '>=', $minRooms],
                ['bed_qty', '>=', $minBeds],
                ['is_visible', '=', 1]
                ])
            ->whereHas('services', function ($query) use ($services) {
                        return $query->whereIn('services.id', $services);
                    })->get();
    }

    private function queryNoServices($ids, $minRooms, $minBeds)
    {
        return Apartment::with('services', 'reviews')
            ->whereIn('id', $ids)
            ->where([
                ['room_qty', '>=', $minRooms],
                ['bed_qty', '>=', $minBeds],
                ['is_visible', '=', 1]
                ])
            ->get();
    }
}
