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
            // Add role_id column, assuming integer and nullable
            $table->unsignedBigInteger('role_id')->nullable()->after('id');

            // Optional: add foreign key if you have a roles table
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first if exists
            // $table->dropForeign(['role_id']);
            
            // Then drop column
            $table->dropColumn('role_id');
        });
    }
};