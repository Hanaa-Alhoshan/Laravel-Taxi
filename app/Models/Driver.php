<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table='drivers';
    protected $primarykey='driver_id'; 
    public $timestamp=true;
    protected $fillable=[
    
        'id',
        'birth_date',
      'driving_license_num',
      'exp_date',
      'lon',
      'lat',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');

    }
    
  public function ratings(){
    return $this->hasMany(Rating::class,'driver_id');
}
public function cab()
    {
        return $this->belongsTo(Cab::class, 'cab_id');

    }
  
    public function distances(){
        return $this->hasMany(Distance::class,'driver_id')->orderBy('dist');
    }

}
