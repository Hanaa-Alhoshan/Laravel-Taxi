<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cab_Ride extends Model
{
    use HasFactory;
    protected $table='cab_rides';
    //protected $primarykey='id'; 
   
    public $timestamp=true;
    protected $fillable=[
      'order_start_point',
      'order_end_point',
      'action_id',
      //'gbs_start_point',
      //'gbs_end_point',
      'pay_type',
      'canceled',
      'ride_status',
      'lont',
      'latt',
      'order_time'
    ];
    public function user_requests(){
      return $this->hasMany(User_Request::class,'id');
  }
  public function group_rides(){
    return $this->hasMany(Group_Ride::class,'id');
}

    public function distances(){
      return $this->hasMany(Distance::class,'id');
  }
  public function pay_action()
    {
        return $this->belongsTo(Pay_Action::class, 'action_id');

    }
}
