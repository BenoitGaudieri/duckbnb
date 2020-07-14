<?php

namespace App\Http\Controllers;
use App\Apartment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $apartments = Apartment::orderBy('views', 'desc')->limit(6)->get();

        return view('guests.index', compact('apartments'));
    }
}
