<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserved extends Model
{
    use HasFactory;

    protected $table = "reserved";

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

    public function reserved_detail()
    {
        return $this->hasOne(Reserved_detail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function contact(){
        return $this->belongsTo(Customer::class,'contact_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }
}
