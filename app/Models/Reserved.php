<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserved extends Model
{
    use HasFactory;

    protected $fillalble = [
        'serial_number',
        'user_id',
        'customer_id',
        'quotation_id',
        'car_id',
        'contact_id',
        'place_send',
        'estimate_send',
        'status_reserved',
        'payment_by',
        'payment_bank',
        'payment_no',
        'reserved_date'
    ];
}
