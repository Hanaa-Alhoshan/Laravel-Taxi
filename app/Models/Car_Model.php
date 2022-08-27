<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_Model extends Model
{
    use HasFactory;
    protected $table='car_models';
    protected $primarykey='car_model_id'; 
    public $timestamp=true;
    protected $fillable=[
      'model_name',
      'model_desc',

    ];
    public function cabs(){
      return $this->hasMany(Cab::class,'car_model_id');
  }
}
