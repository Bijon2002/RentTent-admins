<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\FoodMenu;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',  // food_menu id
        'amount',
        'status',
        'payment_info',
    ];

    protected $casts = [
        'payment_info' => 'array',
    ];

    public $timestamps = true;

    // =======================
    // Relation to User
    // =======================
    public function user() {
        // ✅ Use actual PK 'user_id' in users table
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // =======================
    // Relation to Vendor / Food Menu
    // =======================
    public function vendor() {
        return $this->belongsTo(FoodMenu::class, 'vendor_id', 'menu_id');
    }
}
