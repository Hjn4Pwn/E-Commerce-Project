<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFlavor extends Model
{
    use HasFactory;

    protected $table = 'product_flavors';

    protected $fillable = [
        'product_id',
        'flavor_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function flavor()
    {
        return $this->belongsTo(Flavor::class, 'flavor_id');
    }
}
