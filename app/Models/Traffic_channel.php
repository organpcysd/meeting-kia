<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic_channel extends Model
{
    use HasFactory;

    public $table = "traffic_channel";

    protected $fillable = [
        'channel_name',
    ];
}
