<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boarding extends Model
{
    use HasFactory;

    protected $table = 'boarding_list';   // custom table name
    protected $primaryKey = 'boarding_id'; // custom PK

protected $fillable = [
        'title',
        'description',
        'location',
        'monthly_rent',
        'advance_percent',
        'is_refundable',
        'room_type',
        'room_size',
        'is_food_included',
        'gender_preference',
        'wifi',
        'parking',
        'laundry',
        'attached_bathroom',
        'furnished',
        'property_doc_image',
        'police_report_image',
        'privacy_policy',
        'posted_date',
        'user_id',
        'is_approved',
        'trust_score',
        'police_zone_rating',
        'availability_status'
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'user_id');
}
public function photos()
{
    return $this->hasMany(RoomPhoto::class, 'boarding_id', 'boarding_id');
}

}
