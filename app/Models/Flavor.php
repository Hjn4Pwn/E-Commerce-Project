<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;
use Elastic\ScoutDriverPlus\Searchable;

class Flavor extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
    ];

    // public function productFlavors()
    // {
    //     return $this->hasMany(ProductFlavor::class, "flavor_id");
    // }

    public function carts()
    {
        return $this->hasMany(CartItem::class, 'flavor_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_flavors')
            ->withPivot('quantity');
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
            'type' => 'flavor',
        ];
    }
}
