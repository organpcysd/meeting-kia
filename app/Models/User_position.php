<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_position extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'publish',
    ];

    public function users()
    {
        return $this->belongsToMany(User_position::class, 'user_has_positions', 'user_id', 'position_id');
    }
}
