<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Received extends Model
{
    use HasFactory;

    protected $table = "received";

    protected $fillalble = [
        'serial_number',
        'user_id',
        'customer_id',
        'reserved_id',
        'car_id',
        'stock_id',
        'payment_by',
        'received_date'
    ];

    public function received_detail()
    {
        return $this->hasOne(Received_detail::class);
    }
}
