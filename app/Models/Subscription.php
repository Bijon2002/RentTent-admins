<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // ✅ Mass assignable fields
    protected $fillable = [
        'user_id',
        'vendor_id',  // food_menu id
        'amount',
        'status',
        'payment_info',
    ];

    // ✅ Auto convert JSON <-> array
    protected $casts = [
        'payment_info' => 'array',
    ];

    // ✅ Ensure created_at & updated_at are automatically managed
    public $timestamps = true;

    // =======================
    // Relation to User
    // =======================
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // =======================
    // Relation to Vendor / Food Menu
    // =======================
    public function vendor() {
        return $this->belongsTo(FoodMenu::class, 'vendor_id', 'menu_id');
    }
}
