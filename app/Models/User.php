<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $primarykey='id'; 
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'image',
        'isAdmin',
        'isDriver',
        'fcm_token'
   
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    public function drivers(){
        return $this->hasMany(Driver::class,'id');
    }
    public function customers(){
        return $this->hasMany(Customer::class,'id');
    }
    public function account(){
        return $this->hasOne(Account::class,'id');
    }
}
