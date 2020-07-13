<?php

namespace App\Http\Controllers;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function show(Apartment $apartment)
    {
        //salvare in db
        if(Auth::id() <> $apartment['user_id']) {
            $apartment['views'] = $apartment['views'] + 1;
            $saved = $apartment->save();
        }    
        
        return view("guests.show", compact("apartment"));
    }
}
