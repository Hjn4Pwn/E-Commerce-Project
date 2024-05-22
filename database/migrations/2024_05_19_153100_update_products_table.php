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
            // Thay đổi kiểu dữ liệu của các cột
            $table->integer('quantity_sold')->default(0)->change();
            $table->integer('sale')->default(0)->change();
            $table->longText('short_description')->nullable()->change();

            // Di chuyển các cột ra trước cột created_at
            // $table->integer('quantity_sold')->default(0)->before('created_at')->change();
            // $table->integer('sale')->default(0)->after('quantity_sold')->change();
            // $table->longText('short_description')->nullable()->after('sale')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Đặt lại kiểu dữ liệu ban đầu
            $table->string('quantity_sold')->change();
            $table->string('sale')->change();
            $table->string('short_description')->change();
        });
    }
};
