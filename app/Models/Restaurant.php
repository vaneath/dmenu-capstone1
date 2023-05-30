<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected static function booted()
    {
       
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
