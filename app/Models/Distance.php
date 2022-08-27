<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    use HasFactory;
    protected $table='distances';
    protected $primarykey='dist_id'; 
    public $timestamp=true;
    protected $fillable=[
      'driver_id',
      'id',
      'dist',
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');

    }
    public function cab_ride()
    {
        return $this->belongsTo(Cab_Ride::class, 'id')->orderBy('dist');

    }

}
