<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxPolicy()
    {
        return $this->belongsTo(TaxPolicy::class);
    }
}