<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'inventory_quantity',
        'image_path',
        'inclusions' // 🔧 Include this if you want to mass assign it
    ];

    protected $casts = [
        'inclusions' => 'array', // 🔧 Cast as array
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDetailedImagePathAttribute()
    {
        return str_replace('simple', 'detailed', $this->image_path);
    }
}