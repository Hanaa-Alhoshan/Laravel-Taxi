<?php

namespace App\Http\Controllers;
use App\Models\Cab_Ride;
use App\Models\Driver;
use App\Models\Distance;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Haversine;
use App\Http\Controllers\NotificationController;
use App\Models\Customer;
use App\Models\User_Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function acceptRequest(Request $request , Cab_Ride $cab_ride,Driver $driver){
        $this->authorize('accept_request');
        $cab_ride->taken=1;
        $cab_ride->save();
        $driver->available=0;
        $driver->save();
        //$user=Auth::user();
       // $w=$user->id;
        $q=$cab_ride->user_requests()->get();
       
        foreach($q as $q){
            $qq= $q->customer_id;
        }
       $mess='Yay!';
        $mess2='Your order is accepted , your driver on the way...';
        $noti_controller = new NotificationController;
        $noti_controller->sendNotification($qq,$mess,$mess2);
         return "done";
    }
    public function distance(Cab_Ride $cab_ride,Driver $driver,Distance $distance ){
     //   $this->authorize('show_requests');
        $latt=$cab_ride->latt;
        $lont=$cab_ride->lont;
        
        $distances = $cab_ride->distances()->get();
        $mindist=$distance['dist'];
        foreach (Driver::all() as $driver){
            $lat=$driver->lat;
            $lon=$driver->lon;
            $coordinate1 = new Coordinate($lat, $lon);
            $coordinate2 = new Coordinate($latt,  $lont); 
            $dis= $coordinate1->getDistance($coordinate2, new Haversine());
            $cab_ride->distances()->create([
                'driver_id'=>$driver->id,   
                'id'=>$cab_ride->id,
                'dist'=>$dis/1000,
               ]);
           $wiss=$driver->distances()->min('dist');
           $k=Distance::where('dist',$wiss)->first();
           $kk=$k->driver_id;
           $mess='New Order';
         //  $mess2='Do you want to take it?';
         $mess2=$cab_ride;
           $noti_controller = new NotificationController;
           $noti_controller->sendNotification($kk,$mess,$mess2);
           $cc=json_encode(['data2'=>json_decode( $cab_ride)]);
          return $cc.$kk;
          
        }
    }
   
public function finishRide(Cab_Ride $cab_ride ,Driver $driver  ){
    $this->authorize('finish_ride');
      
    $tt=DB::table('distances')
           ->where('id', $cab_ride->id)
           ->where('driver_id', $driver->id)
           ->get()->toArray();
       $cab_ride->finish=1;
       $cab_ride->taken=1;
       $cab_ride->save();
       $driver->available=1;
       $driver->save();
       $ff=json_encode(['data2'=>json_decode( $cab_ride)]);
        return  $ff;
}
public function rejectRequest(Request $request , Cab_Ride $cab_ride,Driver $driver){
    $this->authorize('reject_request');
  //  $k=$driver->id;
  $q=$cab_ride->user_requests()->get();
       
  foreach($q as $q){
      $qq= $q->customer_id;
  }
    $mess='We are Sorry!';
    $mess2='We couldnot link your order with a driver please try again!';
     $noti_controller = new NotificationController;
          $noti_controller->sendNotification($qq,$mess,$mess2);
      return "rejected";
}
   public function driverLocaion(Request $request){
    $this->authorize('driver_location');
     $driver=Driver::where('driver_id',$request->driver_id)->first();
     $driver->lat=$request->lat;
     $driver->lon=$request->lon;
     $driver->save();
     return $driver;
  }

// public function distance( Cab_Ride $cab_ride,Driver $driver){
//     $lat=$driver->lat;
//     $lon=$driver->lon;
//     $latt=$cab_ride->latt;
//     $lont=$cab_ride->lont;
//     $theta=$lon-$lont;
//     $miles=(sin(deg2rad($lat)))*sin(deg2rad($latt))+(cos(deg2rad($lat))*cos(deg2rad($latt))*cos(deg2rad($theta)));
//     $miles=acos($miles);
//     $miles=rad2deg($miles);
//     $result['miles']=$miles*60*1.1515;
//     $result['kilometers']=$result['miles']*1.609344;
//     $result['meters']=$result['kilometers']*1000;
//     return $result;
// }
}