<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Received_detail extends Model
{
    use HasFactory;

    protected $table = "received_detail";

    protected $fillable = [
        'received_id',
        'condition',
        'payable',
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

    public function received(){
        return $this->belongsTo(Received::class, 'received_id', 'id');
    }
}
