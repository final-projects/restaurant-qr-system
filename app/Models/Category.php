<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];

    // Example relation: a category has many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
