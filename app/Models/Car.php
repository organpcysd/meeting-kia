<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = "car";

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
        return $this->belongsTo(Car_color::class,'color_id','id');
    }

    public function car_model(){
        return $this->belongsTo(Car_model::class,'model_id', 'id');
    }

    public function car_type(){
        return $this->belongsTo(Car_type::class,'type_id', 'id');
    }

    public function car_level(){
        return $this->belongsTo(Car_level::class,'level_id', 'id');
    }

}
