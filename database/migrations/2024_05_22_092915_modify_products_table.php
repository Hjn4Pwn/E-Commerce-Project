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
            // Di chuyển các cột ra trước cột created_at 
            $table->integer('quantity_sold')->after('quantity')->change();
            $table->integer('sale')->after('quantity_sold')->change();
            $table->longText('short_description')->after('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
