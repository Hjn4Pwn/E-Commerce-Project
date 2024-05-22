<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('ProductFlavors', 'product_flavors');
        Schema::rename('ProductImages', 'product_images');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('product_flavors', 'ProductFlavors');
        Schema::rename('product_images', 'ProductImages');
    }
};
