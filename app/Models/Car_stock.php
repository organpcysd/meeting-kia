<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_stock extends Model
{
    use HasFactory;

    protected $table = "car_stock";

    protected $fillable = [
        'car_id',
        'number_chassis',
        'number_engine',
        'status',
    ];

    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }
}
