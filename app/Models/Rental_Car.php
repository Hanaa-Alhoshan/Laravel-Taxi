<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental_Car extends Model
{
    use HasFactory;
    protected $table='rental_cars';
  //  protected $primarykey='id';
    public $timestamp=true;
    
    protected $fillable=[
        'customer_id',
       'car_type',
       'model_name',
       'manufactor_year',
       'technical_condition',
       'price'
       ,'img_url'
      ];
      public function customer()
      {
          return $this->belongsTo(Customer::class, 'customer_id');
  
      }
}
