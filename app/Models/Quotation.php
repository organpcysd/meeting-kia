<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public $table = 'quotation';

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
}
