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
        Schema::table('flavors', function (Blueprint $table) {
            $table->renameColumn('flavor_id', 'id');
            $table->renameColumn('flavor_name', 'name');
        });

        Schema::table('ProductImages', function (Blueprint $table) {
            $table->renameColumn('product_image_id', 'id');
            $table->renameColumn('image_url', 'path');
        });

        Schema::table('ProductFlavors', function (Blueprint $table) {
            $table->renameColumn('product_flavor_id', 'id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('product_id', 'id');
            $table->renameColumn('product_name', 'name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('category_id', 'id');
            $table->renameColumn('category_name', 'name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flavors', function (Blueprint $table) {
            $table->renameColumn('id', 'flavor_id');
            $table->renameColumn('name', 'flavor_name');
        });

        Schema::table('ProductImages', function (Blueprint $table) {
            $table->renameColumn('id', 'product_image_id');
            $table->renameColumn('path', 'image_url');
        });

        Schema::table('ProductFlavors', function (Blueprint $table) {
            $table->renameColumn('id', 'product_flavor_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('id', 'product_id');
            $table->renameColumn('name', 'product_name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('id', 'category_id');
            $table->renameColumn('name', 'category_name');
        });
    }
};
