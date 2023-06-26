<?php

namespace App\Models;

use DateTimeInterface;
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
