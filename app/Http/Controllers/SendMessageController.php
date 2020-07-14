<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Mail\SendMessage;

class SendMessageController extends Controller
{
    function send(Request $request, Apartment $apartment)
    {
        $address = $apartment->user->email;
        
        $this->validate($request, [
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = array(
            'email' => $request->email,
            'message' => $request->message,
        );

        Mail::to($address)->send(new SendMessage($data));
        return back()->with('success', 'Grazie per averci contattato');
    }
}
