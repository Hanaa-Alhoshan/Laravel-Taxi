<?php

namespace App\Http\Controllers;

use App\Models\Rental_Car;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $price_from = $request->query('price_from');
        $price_to = $request->query('price_to');
        $car_type=$request->query('car_type');
        $carQuery = Rental_Car::query();
        if ($price_from ){
            $carQuery->where('price' , '>=', $price_from);
        }
        if ($price_to ){
            $carQuery->where('price' , '<=', $price_to );

        }
        if ($car_type){
            $carQuery->where('car_type' , $car_type);

        }
        $cars =  $carQuery->get();
        $car=Rental_Car::latest()->paginate(4);
        $c=json_encode(['data2'=>json_decode($cars)]);

        return $c;

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'car_type'      => 'required',
            'model_name'      => 'required' ,
            'technical_condition'  => 'required',
            'price'=> 'required',
            'img_url'    =>'required',
              
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $user= Auth::user();
        $cust=Customer::where('id',$user->id)->first();
        $file_extension=$request->img_url->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path='images/cars';
        $request->img_url->move($path,$file_name);
      
       
        $rental_car = Rental_Car::create([
            'car_type'      => $request->car_type,
            'model_name'      => $request->model_name,
           'manufactor_year ' =>  $request->manufactor_year,
            'technical_condition'  => $request->technical_condition,
            'price'=>$request->price,
        'customer_id'=>$user->id,
        'img_url'=>$file_name
     ]);

        return response()->json($rental_car, 201);

    }

    public function update(Request $request)
    {
      $user= Auth::user();
      $cust=Customer::where('id',$user->id)->first();
      $rental_car=Rental_Car::where('id',$request->id)->first();
      $rental_car->update($request->all());
      return response()->json($rental_car, 201);

}
public function show(Request $request)
{
    $user= Auth::user();
    $cust=Customer::where('id',$user->id)->first();
    $rental_car=Rental_Car::where('id',$request->id)->first();
    return response()->json($rental_car, 201);
}

public function destroy(Request $request)
{  $user= Auth::user();
    $cust=Customer::where('id',$user->id)->first();
       $rental_car=Rental_Car::where('id',$request->id)->first();
       $rental_car->delete();
    return "car deleted successfully";
}
}
