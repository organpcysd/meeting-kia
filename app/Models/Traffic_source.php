<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic_source extends Model
{
    use HasFactory;

    protected $table = "traffic_source";

    protected $fillable = [
        'source_name',
    ];

    public function traffic(){
        $this->hasOne(Traffic::class);
    }
}
