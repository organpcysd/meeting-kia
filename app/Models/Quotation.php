<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotation';

    protected $fillable = [
        'serial_number',
        'user_id',
        'customer_id',
        'car_id',
        'place_send',
        'estimate_send',
        'allow_status',
        'quotation_status',
    ];

    public function quotation_detail(){
        return $this->hasOne(Quotation_detail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
