<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class SearchController extends Controller
{
    public function index() 
    {
        return view('guests.search');
    }
    
    public function search(Request $request)
    {
        $ids = $request->id[0];
        $array = explode(',', $ids);

        $apartments = [];

        foreach ($array as $item => $key) {
            $apartments[] = Apartment::where('id', $key)->get();
        }
        
        dd($apartments);

        return view('guests.search', compact('apartments'));
    }
}
