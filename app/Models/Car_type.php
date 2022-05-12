<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_type extends Model
{
    use HasFactory;

    protected $table = "car_type";

    protected $fillable = [
        'type_name',
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
