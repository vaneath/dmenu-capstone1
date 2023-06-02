<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'is_visible',
        'img_url',
        'name',
        'sort_number',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
