<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $table = 'users';
    protected $fillable = [
        'user_prefix_id',
        'f_name',
        'l_name',
        'nickname',
        'born',
        'position',
        'line_id',
        'phone',
        'hobby',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activestatus(){
        return $this->status == 1;
    }

    public function user_prefix()
    {
        return $this->belongsTo(User_prefix::class,'user_prefix_id','id');
    }

    public function user_position()
    {
        return $this->belongsToMany(User_position::class, 'user_has_positions', 'user_id', 'position_id');
    }

    public function quotation(){
        return $this->hasOne(Quotation::class);
    }

    public function customer(){
        return $this->hasOne(Customer::class);
    }

    public function traffic(){
        $this->hasOne(Traffic::class);
    }

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'admin/profile';
    }
}
