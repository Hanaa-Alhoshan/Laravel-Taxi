<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_Action extends Model
{
    use HasFactory;
    protected $table='pay_actions';
    protected $primarykey='action_id'; 
    public $timestamp=true;
    protected $fillable=[
        'account_id',
      'date',
      'amount',
      'operation',

    ];
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');

    }
    public function cab_ride()
    {
        return $this->hasOne(Cab_Ride::class, 'action_id');

    }

}
