<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'flavor_id',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            $order->items()->each(function ($item) {
                $item->delete();
            });
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function flavor()
    {
        return $this->belongsTo(Flavor::class, 'flavor_id');
    }
}
