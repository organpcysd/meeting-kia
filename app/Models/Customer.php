<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";
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
        return $this->belongsTo(User_prefix::class,'prefix_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'staff_id','id');
    }

    public function customer_follow(){
        return $this->hasMany(Customer_follow::class);
    }

    public function customer_address(){
        return $this->hasOne(Customer_address::class);
    }

    public function quotation(){
        return $this->hasOne(Quotation::class);
    }

    public function traffic(){
        $this->hasOne(Traffic::class);
    }

}
