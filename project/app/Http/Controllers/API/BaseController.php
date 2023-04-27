<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendRespones($result , $message)
    {
        $response = [

            'success' => true,
            'data' => $result,
            'message' =>$message
        ];
        return response()->json($response, 200);
     }


     public function sendError($error , $errormessage=[] , $code = 404){
        $response = [

            'success' => false,
            'data' => $error
        ];
        if (!empty($errormessage)) {
            $response['data'] = $errormessage;
        }
        return response()->json($response, $code);
     }
}



