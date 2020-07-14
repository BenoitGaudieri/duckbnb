<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMessage;

class SendMessageController extends Controller
{
    function index()
    {
        return view("guests.show");
    }
    function send(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data = array(
            'email' => $request->email,
            'message' => $request->message,
        );
        Mail::to(Auth::user()->email)->send(new SendMessage($data));
        return back()->with('success', 'Grazie per averci contattato');
    }
}
