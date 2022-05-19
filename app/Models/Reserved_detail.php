<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserved_detail extends Model
{
    use HasFactory;

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
}
