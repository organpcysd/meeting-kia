<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_gift extends Model
{
    use HasFactory;

    protected $table = "car_gift";

    protected $fillable = [
        'gift_name',
    ];

    public function quotation_detail(){
        return $this->belongsToMany(Quotation_detail::class,'quotation_has_accessories','quotation_detail_id','accessories_id');
    }

    public function reserved_detail(){
        return $this->belongsToMany(Reserved_detail::class,'reserved_has_accessories','reserved_detail_id','accessories_id');
    }
}
