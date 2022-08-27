<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_Type extends Model
{
    use HasFactory;
    protected $table='pay_types';
    protected $primarykey='pay_type_id'; 
    public $timestamp=true;
    protected $fillable=[
      'type_name',
      
    ];
  
}
