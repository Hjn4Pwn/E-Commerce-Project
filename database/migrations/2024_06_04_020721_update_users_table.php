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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('image', 'avatar');
            $table->integer('province')->nullable()->after('password')->change();
            $table->integer('district')->nullable()->after('province')->change();
            $table->integer('ward')->nullable()->after('district')->change();
            $table->dropColumn('payment');
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
