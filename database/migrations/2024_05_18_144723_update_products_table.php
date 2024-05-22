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
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('id', 'product_id');
            $table->renameColumn('name', 'product_name');
            $table->renameColumn('categoryId', 'category_id');
            $table->renameColumn('describe', 'description');
            $table->string('quantity_sold')->nullable();
            $table->string('sale')->nullable();
            $table->string('short_description')->nullable();
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Đổi lại tên các cột về như cũ
            $table->renameColumn('product_id', 'id');
            $table->renameColumn('product_name', 'name');
            $table->renameColumn('category_id', 'categoryId');
            $table->renameColumn('description', 'describe');

            // Xóa các cột mới thêm vào
            $table->dropColumn(['quantity_sold', 'sale', 'short_description']);

            // Thêm lại cột 'image'
            $table->string('image')->nullable();
        });
    }

};
