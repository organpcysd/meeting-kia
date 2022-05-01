<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;

    public $table = 'canton';

    protected $fillable = [
        'zip_code',
        'name_th',
        'name_en',
        'district_id',
    ];

    public function customer_address(){
        return $this->belongsTo(Customer_address::class);
    }

    public function districts(){
        return $this->hasOne(Districts::class,'id','district_id');
    }
}
