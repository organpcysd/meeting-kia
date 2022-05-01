<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_follow extends Model
{
    use HasFactory;

    public $table = 'customer_follow';

    protected $fillable = [
        'customer_id',
        'follow_up',
        'follow_up_customer',
        'recomment_ceo',
        'follow_date',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
