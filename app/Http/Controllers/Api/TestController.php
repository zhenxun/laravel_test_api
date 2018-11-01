<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function post(Request $request){

        $token = 'cd6f7d55f984676a09d5918215fee0f6';

        $header_auth = $request->header('Authorization');

        if(empty($header_auth)){
            return response()->json(['status' => 'error', 'message' => 'Authorization missing']);
        }

        if($header_auth != $token){
            return response()->json(['status'=> 'error', 'message' => 'Authorization mismatch']);
        }

        $request_json = $request->json()->all();

        if(!isset($request_json['id']) && !isset($request_json['machine_uuid'])){
            return response()->json(['status' => 'error', 'message' => 'fields empty']);
        }

        $data [] = [
            'id' => $request_json['id'],
            'machine_uuid' => $request_json['machine_uuid']
        ];

        return response()->json($data);

    }
}
