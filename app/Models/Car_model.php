<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_model extends Model
{
    use HasFactory;

    protected $table = "car_model";

    protected $fillable = [
        'model_name',
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function car_level()
    {
        return $this->hasOne(Car_level::class);
    }

    public function traffic_car_item()
    {
        return $this->hasMany(Traffic_car_item::class);
    }
}
