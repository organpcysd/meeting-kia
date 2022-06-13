<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Traffic extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
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
        'testdrive',
        'staff_pick'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('traffic');
    }

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

    public function traffic_car_item(){
        return $this->hasOne(Traffic_car_item::class);
    }
}
