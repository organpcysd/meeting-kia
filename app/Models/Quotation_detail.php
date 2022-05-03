<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'condition',
        'price_car',
        'payment_discount',
        'price_car_net',
        'term_credit',
        'interest',
        'hire_purchase',
        'term_payment',
        'payment_down',
        'payment_down_discount',
        'deposit_roll',
        'payment_decorate',
        'payment_insurance',
        'payment_other',
        'car_change',
        'payment_car_turn',
        'subtotal',
        'accessories',
    ];

    public function car_gift(){
        return $this->belongsToMany(Car_gift::class,'quotation_has_accessories','quotation_detail_id','accessories_id');
    }
}
