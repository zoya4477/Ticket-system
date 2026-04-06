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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // User who created the ticket
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Agent assigned to ticket (nullable)
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('title');
            $table->text('description');

            // Status & priority
            $table->enum('status',['open','in_progress','closed'])->default('open');
            $table->enum('priority',['low','medium','high','urgent'])->default('low');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};