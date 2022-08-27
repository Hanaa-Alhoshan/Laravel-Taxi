<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

use Illuminate\Database\Eloquent\Collection;
class ManagerController extends Controller
{

  public function index(){
    $myArray=[];
    $users=User::where('isDriver', '=', 1)->get();
  
    foreach ($users as $users) {
    $driver=Driver::where('id',$users->id)->first();
    $users->driver_id=$driver->driver_id;
       $r=array_push($myArray,$users);
  }

   return response()->json(['data' => $myArray,200]);     
  }
  
  public function create(Request $request){
     $this->authorize('drivers_create');
     $user= Auth::user();
     $user=User::where('id',$user->id)->first();
     $validator = Validator::make($request->all(), [
      'name'=> 'required',
      'email'=> 'required|email',
     'password'=>'required',
      'phone_number'=>'required',
      'driving_license_num'=>'required'
  ]);


  if ($validator->fails()) {
      return $validator->errors();
  }

    $user = User::create([
      'name'=> $request->name,
      'email'=> $request->email,
     'password'=>(Hash::make($request->password)),
      'phone_number'=>$request->phone_number,
      
    ]);
    $user->isDriver=1;
    $user->save();
    $driver=$user->drivers()->create([
      'id' => $user->id,
      'birth_date'=>$request->birth_date,
     'driving_license_num'=>$request->driving_license_num,
     'exp_date'=>$request->exp_date
      
     ]);
     $user->birth_date=$driver->birth_date;
     $user->driving_license_num=$driver->driving_license_num;
     $user->exp_date=$driver->exp_date;
    
     $k=json_encode(['data1'=>json_decode( $user)]);
     return $k;
    
  }

  public function show(Request $request){
    $user= Auth::user();
    $user=User::where('id',$request->id)->first();

    $driver=Driver::where('id',$request->id)->first();
    $user->birth_date=$driver->birth_date;
    $user->driving_license_num=$driver->driving_license_num;
    $user->exp_date=$driver->exp_date;
    $user->driver_id=$driver->driver_id;
    $k=json_encode(['data1'=>json_decode( $user)]);
      return $k; 
                }

  public function update(Request $request ){
    $this->authorize('drivers_edit');
   $user= Auth::user();
    $driver=Driver::where('driver_id', $request->driver_id)->first();
  
    $driver->update($request->all());
  
      $user=User::find($request->id);
     $user->update( $request->all() );
     $driver->save();
     $user->save();
     $user->birth_date=$driver->birth_date;
     $user->driving_license_num=$driver->driving_license_num;
     $user->exp_date=$driver->exp_date;
     $k=json_encode(['data1'=>json_decode( $user)]);
     return $k;
    
  }
  public function destroy(Request $request){
    $this->authorize('drivers_delete');
    $d=Driver::where('driver_id', $request->driver_id);
    $d->delete();
    $user=User::find($request->id);
    $user->delete();
    return "DELETED SUCESSFULY";
  }
}
