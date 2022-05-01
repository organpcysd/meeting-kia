<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_color extends Model
{
    use HasFactory;

    public $table = "car_color";

    protected $fillable = [
        'color_name',
        'color_code',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
