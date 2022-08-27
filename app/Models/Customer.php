<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $primarykey='customer_id'; 
    public $timestamp=true;
    protected $fillable=[
      'driver_id',
      'rating_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');

    }
    public function user_requests(){
      return $this->hasMany(User_Request::class,'customer_id');
  }
  public function ratings(){
    return $this->hasMany(Rating::class,'customer_id');
}

public function group_ride(){
  return $this->hasMany(Group_Ride::class,'customer_id');
}
public function rental_cars(){
  return $this->hasMany(Rental_Car::class,'customer_id');
}
}
