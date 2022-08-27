<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendRespond($result,$message){
        $response=[
            'success'=> true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json([$result],200);
    }
    public function sendError($error,$code=404){
        $response=[
            'Error'=> false,
            'Massage' => $error,
           
        ];
        if (!empty($errormessage)){
            $response['data']=$errormessage;
        }
        return response()->json($response,$code);
    }
}
