<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $table = "Customer";
    protected $fillable = [
        'prefix_id',
        'citizen_id',
        'itax_id',
        'f_name',
        'l_name',
        'nickname',
        'born',
        'vocation',
        'phone',
        'fax',
        'email',
        'line_id',
        'hobby',
        'customer_type',
        'status',
        'staff_id',
    ];

    public function customer_prefix(){
        return $this->belongsTo(User_prefix::class,'id','prefix_id');
    }

    public function customer_follow(){
        return $this->hasMany(Customer_follow::class);
    }

    public function customer_address(){
        return $this->hasOne(Customer_address::class);
    }

}
