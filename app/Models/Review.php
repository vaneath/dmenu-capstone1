<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'id',
        'user_id',
        'restaurant_id',
        'order_id',
        'overall_rating',
        'expires_at',
        'comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reviewItems()
    {
        return $this->hasMany(ReviewItem::class);
    }

    public function reviewItem()
    {
        return $this->belongsTo(ReviewItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
