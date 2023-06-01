<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxPolicy extends Model
{
    use HasFactory;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
