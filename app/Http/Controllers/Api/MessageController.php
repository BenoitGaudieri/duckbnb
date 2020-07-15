<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\User;

class MessageController extends Controller
{
    public function inbox(User $user)
    {
        $apartments = Apartment::where('user_id', '=', $user->id)->with('messages')->get();

        $res = [
            'error' => '',
            'response' => []
        ];

        if(!empty($apartments)) {
            foreach ($apartments as $apartment) {
                foreach ($apartment->messages as $message) {
                    $message['title'] = $apartment->title;
                    $res['response'][] = $message;
                }
            }
        } else {
            $res['error'] = 'Non hai messaggi';
        }

        return response()->json($res);
    }
}
