<?php

namespace App\Models;

use App\Services\ElasticsearchService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Elastic\ScoutDriverPlus\Searchable;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($category) {
            app(ElasticsearchService::class)->syncModel($category, 'category');
        });

        static::deleted(function ($category) {
            app(ElasticsearchService::class)->removeModel($category);
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
    //         'type' => 'category',
    //     ];
    // }
}
