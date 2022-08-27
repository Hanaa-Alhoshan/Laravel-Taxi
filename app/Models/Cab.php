<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cab extends Model
{

    protected $table='cabs';
    protected $primarykey='cab_id'; 
    public $timestamp=true;
    protected $fillable=[
    'license_plate',
      'car_model_id',
      'manufactor_year',
    ];
    
  public function group_rides(){
    return $this->hasMany(Group_Ride::class,'cab_id');
}
public function car_models()
{
    return $this->belongsTo(Car_Model::class, 'car_model_id');

}
public function driver(){
  return $this->hasOne(Driver::class,'cab_id');
}}
