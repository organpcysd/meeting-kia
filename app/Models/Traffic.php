<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;
    protected $table = "traffic";

    protected $fillable = [
        'customer_id',
        'user_id',
        'dicision',
        'source_id',
        'location',
        'target',
        'contact_result',
        'channel_id',
        'tenor',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function source()
    {
        return $this->belongsTo(Traffic_source::class, 'source_id', 'id');
    }

    public function channel()
    {
        return $this->belongsTo(Traffic_channel::class, 'channel_id', 'id');
    }
}
