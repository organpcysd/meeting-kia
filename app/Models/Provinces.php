<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;

    public $table = 'provinces';

    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'geography_id',
    ];

    public function customer_address(){
        return $this->belongsTo(Customer_address::class);
    }

    public function geographies(){
        return $this->hasOne(Geogreaphies::class,'id','geography_id');
    }

    public function districts(){
        return $this->belongsTo(Districts::class);
    }
}
