<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Item;

class OrderItem extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['order_id', 'item_id', 'id', 'quantity', 'amount', 'tax_deduction', 'discount_amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
