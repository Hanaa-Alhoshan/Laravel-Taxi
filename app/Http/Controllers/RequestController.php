<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Cab_Ride;
use App\Models\Customer;
use App\Models\Distance;
use App\Models\Driver;


use App\Models\User_Request;
//use App\Http\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\HasApiTokens;

use DB;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'order_start_point'=> 'required',
            'order_end_point'=> 'required',
            'order_time' => 'required' ,
         //  'pay_type'   => 'required',
          //'ride_status'=> 'required',
            ]
       );
       if($validator->fails()){
        return $validator->errors();
    }
       $cab_ride=Cab_Ride::create($request->all());
      $user= Auth::user();
      $cust=Customer::where('id',$user->id)->first();
     
      $cab_ride->user_requests()->create([
              'customer_id' => $user->id,

              'id'=>$cab_ride->id
             ]);
       
        
       return response()->json($cab_ride, 201);
   
    }
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function canceled( Cab_Ride $cab_ride)
    {  
           $cab_ride->canceled=0;
           $cab_ride->save();
          
        return "Ride canceled ";

    }
     public function groupRide(Cab_Ride $cab_ride){
      $cab_ride->ride_status="group ride";
      $user= Auth::user();
      $cust=Customer::where('id',$user->id)->first();
           $cab_ride->group_rides()->create([
            'customer_id' => $user->id,
             'id'=>$cab_ride->id
             
            ]);

            $cab_ride->save();

            return response()->json($cab_ride, 201);
            }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cab_ride $cab_ride)
    {
       
        $cab_ride = Cab_Ride::find(
            $cab_ride->id);
           
            $cab_ride->delete();
        return "request deleted successfully";
       
    }
}
