<?php

namespace App\Http\Controllers;
use App\Apartment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $res = Apartment::orderBy('views', 'desc')->get();
        $now = Carbon::now();

        $apartments = [];

        foreach ($res as $apartment) {
            
            if(($apartment->sponsorships)->isNotEmpty()) {
                $duration = $apartment->sponsorships[0]->duration;

                foreach ($apartment->sponsorships as $sponsorship) {
                    $sponsorshipDate = $sponsorship->pivot->created_at;
                    $difference = $now->diffInDays($sponsorshipDate);
    
                    if($difference < $duration) {
                        $apartments[] = $apartment;
                    }
                }
            }
        }

        return view('guests.index', compact('apartments'));
    }
}
