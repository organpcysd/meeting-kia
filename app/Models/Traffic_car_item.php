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

    public function traffic(){
        return $this->belongsTo(Traffic::class,'traffic_id','id');
    }
}
