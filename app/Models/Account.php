<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table='accounts';
    protected $primarykey='account_id'; 
    public $timestamp=true;
    protected $fillable=[
      'stat',
      'balance',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');

    }
    public function pay_actions(){
        return $this->hasMany(Pay_Action::class,'account_id');
    }
}
