<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_type extends Model
{
    use HasFactory;

    public $table = "car_type";

    protected $fillable = [
        'type_name',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
