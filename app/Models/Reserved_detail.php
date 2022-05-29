<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserved_detail extends Model
{
    use HasFactory;

    protected $table = "reserved_detail";

    protected $fillable = [
        'reserved_id',
        'condition',
        'payable',
        'price_car',
        'payment_discount',
        'price_car_net',
        'term_credit',
        'interest',
        'payment_regis',
        'hire_purchase',
        'first_purchase',
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
        'accessories_buy',
    ];

    public function reserved(){
        return $this->belongsTo(Reserved::class, 'reserved_id', 'id');
    }

    public function car_gift(){
        return $this->belongsToMany(Car_gift::class,'reserved_has_accessories','reserved_detail_id','accessories_id');
    }
}
