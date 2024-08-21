<?php

namespace App\Models;

use App\Services\ElasticsearchService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;
// use Elastic\ScoutDriverPlus\Searchable;

class Flavor extends Model
{
    use HasFactory;

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

    public static function boot()
    {
        parent::boot();

        static::saved(function ($flavor) {
            app(ElasticsearchService::class)->syncModel($flavor, 'flavor');
        });

        static::deleted(function ($flavor) {
            app(ElasticsearchService::class)->removeModel($flavor);
        });
    }

    // public function searchableAs()
    // {
    //     return 'app_index';
    // }

    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'type' => 'flavor',
    //     ];
    // }
}
