<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_level extends Model
{
    use HasFactory;

    protected $table = "car_level";

    protected $fillable = [
        'level_name',
        'model_id',
    ];

    public function car_model()
    {
        return $this->belongsTo(Car_model::class,'model_id','id');
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function traffic_car_item()
    {
        return $this->hasMany(Traffic_car_item::class);
    }
}
