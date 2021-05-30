<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NodeJSController extends Controller
{
    // NodeJSController::post('badge_users',['badge'=>$badge->ToArray(),
    //                                                                'user_badge'=>$user_badge->ToArray()
    //                ]);
    static function  get($endpoint,$data)
    {
        $api_token = "aa";
        $URL_WEBSOCKET = "http://localhost:5000/" ;
        $response = Http::withToken($api_token)->async()->get($URL_WEBSOCKET.$endpoint,
            $data
        );
        return $response;
    }

    static function  post($endpoint,$data)
    {
        $api_token = "aa";
        $URL_WEBSOCKET = "http://localhost:5000/" ;
        $response = Http::withToken($api_token)->post($URL_WEBSOCKET.$endpoint,
            $data
        );
        return $response;
    }
}
