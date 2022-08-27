<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Driver;
use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;


use  App\Http\Controllers\BaseController as BaseController ;

use function PHPUnit\Framework\returnSelf;

class SigninController extends BaseController
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'email'=> 'required|email|max:255|regex:/(.*)@gmail\.com/',
           'password'=>'required',
            'c_password'=>'required|same:password',
            'phone_number'=>'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
       
        $file_extension=$request->image->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path='images/users';
        $request->image->move($path,$file_name);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'c_password'=>$request->c_password,
            'phone_number'=>$request->phone_number,
            'image'=>$file_name,
            'fcm_token'=>$request->fcm_token
    ]);
        $user->save();
        $success['token'] = $user->createToken('hanaakenana5555')->plainTextToken;
          
        $success['user'] =  $user;

        $user->customers()->create([
             'id'=>$user->id]);
        return $this->sendRespond($success,'User register successfully.');
        
    }

    public function login(Request $request){
        $user = User::where('email' , $request->email)->first();
        if ($user) {
            $check = (Hash::check($request->password, $user->password));  
                 $cust=Customer::where('id',$user->id)->first();
            if ($check){
                // $user->customer_id=$cust->customer_id;
                $user->token= $user->createToken('hanaakenana5555')->plainTextToken;          
                $success['user'] = $user;
                $driver=DB::table('drivers')->where('id',$user->id)->get();
            if ($driver) {
              foreach ($driver as $driver) {
              $user->driver_id=$driver->driver_id;
                }
                 }
                
            return response()->json($success);
            
            }
             else {
              
                $error['message']='wrong password';
                return $this->sendError($error,$code=404);
            }
        } else {
            return "account not exist";
        }
    }
  
  
    public function logout(Request $request){
        $request->user()->tokens()->delete();
    }
   
    }

  
              //   $success['token'] = $user->createToken('hanaakenana5555')->plainTextToken;
                // $success['customer'] =  $cust;
               //  $success['user'] =  $user;
                               //  $user->token= $success['token'];

