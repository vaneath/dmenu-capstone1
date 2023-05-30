<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['restaurant_id', 'id', 'table_no', 'is_paid', 'status', 'paid_at', 'tax'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

