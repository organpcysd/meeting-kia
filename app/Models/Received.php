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

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }

    public function car_stock(){
        return $this->belongsTo(Car_stock::class,'stock_id','id');
    }
}
