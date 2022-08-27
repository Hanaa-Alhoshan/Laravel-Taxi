<?php

namespace App\Http\Controllers;

use App\Models\Cab_Ride;
use App\Models\Driver;
use App\Models\Rating;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RatingController extends Controller
{
    public function rate(Request $request)
    {
        $driver=$request->input('driver_id');
        $star_num=$request->input('star_num');
        $cab_ride=$request->input('id');
        $user= Auth::user();
        $cust=Customer::where('id', $user->id)->first();
        $rate=  Rating::create(
            [
                'driver_id' => $driver,
                'id'=> $cab_ride,
                'star_num' =>$star_num,
                'customer_id' =>$user->id,
                'complaint'=>$request->complaint
            ]
        );
    
        $rr=json_encode(['data2'=>json_decode($rate)]);

        return $rr;
    }
    public function showRating(Request $request)
    {
        $this->authorize('drivers_rating');

        $driver=$request->input('driver_id');
        $kk= DB::table('ratings')
    ->where('driver_id', $driver)
    ->get();
        $user= DB::table('users')
    ->where('id', $request->id)
    ->get();
        $driver= DB::table('drivers')
    ->where('driver_id', $driver)
    ->get();
    $user->birth_date=$driver->birth_date;
    $user->driving_license_num=$driver->driving_license_num;
    $user->exp_date=$driver->exp_date;
    $user->driver_id=$driver->driver_id;
    $user->complaint=$kk->complaint;
    $user->star_num=$kk->star_num;
    $m=json_encode(['data1'=>json_decode( $user)]);
        return $m;
    }
}
