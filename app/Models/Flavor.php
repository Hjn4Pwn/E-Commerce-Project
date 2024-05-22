<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function productFlavors()
    {
        return $this->hasMany(ProductFlavor::class, "flavor_id");
    }
}
