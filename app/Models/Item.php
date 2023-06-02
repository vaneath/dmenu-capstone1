<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'img_url',
        'price',
        'discount',
        'weight',
        'is_available',
        'sort_number',
        'category_id',
        'tax_policy_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxPolicy()
    {
        return $this->belongsTo(TaxPolicy::class);
    }
}
