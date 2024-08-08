<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elastic\ScoutDriverPlus\Searchable;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity_sold',
        'sale',
        'weight',
        'description',
        'short_description',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // public function flavors()
    // {
    //     return $this->hasMany(ProductFlavor::class, 'product_id');
    // }

    public function flavors()
    {
        return $this->belongsToMany(Flavor::class, 'product_flavors')
            ->withPivot('quantity');
    }

    public function carts()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function main_image()
    {
        return $this->hasOne(ProductImage::class)->where('sort_order', 1);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Accessor để tính tổng quantity
    public function getTotalQuantityAttribute()
    {
        return $this->flavors->sum(function ($productFlavor) {
            return $productFlavor->pivot->quantity;
        });
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1);
    }


    public function searchableAs()
    {
        return 'app_index';
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => 'product',
        ];
    }
}
