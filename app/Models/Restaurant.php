<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    use HasFactory;

    protected static function booted()
    {
        if(Auth::check()) {
            static::addGlobalScope('user_id', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
