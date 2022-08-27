<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Request extends Model
{
    use HasFactory;
    protected $table='user_requests';
    protected $primarykey='user_request_id'; 
    public $timestamp=true;
    protected $fillable=[
        
        'id',
        'customer_id'
      ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');

    }
    public function cab_rides()
    {
        return $this->belongsTo(Cab_Ride::class, 'id');

    }
}
