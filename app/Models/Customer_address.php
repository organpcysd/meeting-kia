<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_address extends Model
{
    use HasFactory;

    protected $table = 'customer_address';

    protected $fillable = [
        'customer_id',
        'house_number',
        'group',
        'village',
        'alley',
        'road',
        'district_id',
        'canton_id',
        'province_id',
        'zip_code',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function provinces(){
        return $this->hasOne(Provinces::class,'id','province_id');
    }

    public function districts(){
        return $this->hasOne(Districts::class,'id','district_id');
    }

    public function canton(){
        return $this->hasOne(Canton::class,'id','canton_id');
    }
}
