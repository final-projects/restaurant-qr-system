<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'available',
    ];

    /**
     * Relationship: Menu belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor for formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' EGP';
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }
}
