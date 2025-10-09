<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // your table name
    protected $primaryKey = 'id';   // PK

    protected $fillable = [
        'user_id',
        'boarding_id',
        'amount',
        'status',
        'reserved_at',
        'booked_at',
        'is_non_refundable'
    ];

    // Relationships
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function boarding() {
        return $this->belongsTo(Boarding::class, 'boarding_id', 'boarding_id');
    }
}
