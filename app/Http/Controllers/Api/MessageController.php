<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        $res = [
            'error' => '',
            'response' => []
        ];

        if(!empty($messages)) {
            $res['response'] = $messages;
        } else {
            $res['error'] = 'No messages';
        }

        return response()->json($res);
    }
}
