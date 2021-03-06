<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_color extends Model
{
    use HasFactory;

    protected $table = "car_color";

    protected $fillable = [
        'color_name',
        'color_code',
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function traffic_car_item()
    {
        return $this->hasMany(Traffic_car_item::class);
    }
}
