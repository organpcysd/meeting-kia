<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $table = "car";

    protected $fillable = [
        'model_id',
        'color_id',
        'type_id',
        'level_id',
        'engine',
        'gear',
        'price',
        'years',
        'other',
        'total_qty',
        'sold_qty',
        'book_qty',
        'defect_qty',
        'available',
    ];

    public function car_color(){
        return $this->hasOne(Car_color::class,'id','color_id');
    }

    public function car_model(){
        return $this->hasOne(Car_model::class,'id', 'model_id');
    }

    public function car_type(){
        return $this->hasOne(Car_type::class,'id', 'type_id');
    }

    public function car_level(){
        return $this->hasOne(Car_level::class,'id', 'level_id');
    }
}
