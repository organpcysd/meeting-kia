<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_prefix extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_prefix_id');
    }
}
