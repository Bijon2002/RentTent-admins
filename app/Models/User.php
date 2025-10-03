<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id'; // ✅ matches your DB
    public $incrementing = true;       // if auto-increment
    protected $keyType = 'int';        // integer type

    protected $fillable = [
        'name',
        'email',
        'phone',
        'nic_number',
        'role',
        'profile_pic',
        'nic_image',
        'location',
        'password',
        'verification_status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ===============================
    // Vendor relation: one vendor has many food packages
    // ===============================
    public function foods() {
        return $this->hasMany(\App\Models\FoodMenu::class, 'user_id', 'user_id');
    }

    public function subscriptions()
{
    return $this->hasMany(\App\Models\Subscription::class);
}
public function boardings()
{
    return $this->hasMany(Boarding::class, 'user_id', 'user_id');
}


}
