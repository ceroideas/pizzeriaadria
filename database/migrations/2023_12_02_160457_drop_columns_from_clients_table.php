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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropcolumn('email');
            $table->dropcolumn('full_name');
            $table->dropcolumn('password');
            $table->dropcolumn('image');
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('email');
            $table->string('full_name');
            $table->string('password');
            $table->string('image')->nullable();
            $table->dropColumn('phone');
        });
    }
};
