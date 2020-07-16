<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function show(Apartment $apartment)
    {
        if(Auth::id() <> $apartment['user_id']) {
            $newView = new View();
            $newView->apartment_id = $apartment->id;
            $newView->ip = '176.32.27.145';
            
            $saved = $newView->save();
        }    
        
        return view("guests.show", compact("apartment"));
    }
}
