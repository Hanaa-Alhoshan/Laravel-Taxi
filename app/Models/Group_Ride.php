<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Ride extends Model
{
    use HasFactory;
    protected $table='group_rides';
    protected $primarykey='group_ride_id'; 
    public $timestamp=true;
    protected $fillable=[
      'id',
      'customer_id'
    ];
    public function cab_rides()
    {
        return $this->belongsTo(Cab_Ride::class, 'id');

    }
    public function cab()
    {
        return $this->belongsTo(Cab::class, 'cab_id');

    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');

    }
}
