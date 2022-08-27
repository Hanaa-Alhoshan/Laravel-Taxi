<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function refreshToken (Request $request){
        $user_id=$request->user_id;
        $fcm_token=$request->fcm_token;
        User::where('id',$user_id);

    }
    public function sendNotification($id,$message1,$message2 ){
       // $user_id=$request->id;
        $fcm_token=User::find($id)->fcm_token;
        $server_key=env('FCM_SERVER_KEY');
        $fcm=Http::acceptJson()->withToken($server_key)->post(
             'https://fcm.googleapis.com/fcm/send',
               [
                   'to'=>$fcm_token,
                   'notification'=>
                                [
                         'title'=>$message1,
                         'body'=>$message2
                                ] 
               ]
        );
        return json_decode($fcm);
       // return 'kk';

    }
}
