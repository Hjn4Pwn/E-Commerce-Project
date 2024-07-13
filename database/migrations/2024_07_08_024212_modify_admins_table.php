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
        Schema::table('admins', function (Blueprint $table) {
            $table->integer('province_id')->nullable()->after('password');
            $table->integer('district_id')->nullable()->after('province_id');
            $table->integer('ward_id')->nullable()->after('district_id');
            $table->renameColumn('address', 'address_detail');
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
