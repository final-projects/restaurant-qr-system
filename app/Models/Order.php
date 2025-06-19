<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'status'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withPivot('quantity')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
