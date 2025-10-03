<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    protected $primaryKey = 'photo_id';
    protected $fillable = ['boarding_id', 'image_url', 'is_main'];

    public function boarding()
    {
        return $this->belongsTo(Boarding::class, 'boarding_id', 'boarding_id');
    }
}
