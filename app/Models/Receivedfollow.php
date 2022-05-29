<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivedfollow extends Model
{
    use HasFactory;
    protected $table = 'received_follow';
    protected $fillable = [
        'received_id',
        'follow_up',
        'follow_up_customer',
        'recomment_ceo',
        'follow_date',
    ];

    public function received(){
        return $this->belongsTo(Received::class,'received_id','id');
    }
}
