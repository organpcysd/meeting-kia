<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic_car_item extends Model
{
    use HasFactory;

    protected $table = "traffic_car_item";
    protected $fillable = [
        'traffic_id',
        'model_id',
        'level_id',
        'color_id',
    ];

    public function car_color(){
        return $this->belongsTo(Car_color::class,'color_id','id');
    }

    public function car_model(){
        return $this->belongsTo(Car_model::class,'model_id', 'id');
    }

    public function car_level(){
        return $this->belongsTo(Car_level::class,'level_id', 'id');
    }
}
