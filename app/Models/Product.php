<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity',
        'quantity_sold',
        'sale',
        'description',
        'short_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function flavors()
    {
        return $this->hasMany(ProductFlavor::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('sort_order', 1);
    }
}
