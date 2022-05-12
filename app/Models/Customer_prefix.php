<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_prefix extends Model
{
    use HasFactory;

    protected $table = 'customer_prefix';

    protected $fillable = [
        'title',
    ];

    public function customer(){
        return $this->hasOne(Customer::class);
    }
}
