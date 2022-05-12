<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'province_id',
    ];

    public function customer_address(){
        return $this->belongsTo(Customer_address::class);
    }

    public function provinces(){
        return $this->hasOne(Districts::class,'id','province_id');
    }

    public function canton(){
        return $this->belongsTo(Canton::class);
    }
}
