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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
    
            $table->text('description');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            $table->unsignedInteger('estimated_time')->default(0);
            $table->unsignedInteger('used_time')->default(0);
    
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};