<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'food_menu';
    protected $primaryKey = 'menu_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'name',
        'food_type',
        'preference',
        'monthly_fee',
        'image_url',
        'approved',
        'start_date',
        'end_date',
        'description',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
}
