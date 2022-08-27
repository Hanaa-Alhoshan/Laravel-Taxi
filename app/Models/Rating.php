<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table='ratings';
    protected $primarykey='rating_id'; 
    public $timestamp=true;
    protected $fillable=[
      'star_num',
      'driver_id',
      'id',
      'customer_id',
      'complaint'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');

    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');

    }
   
   
}
