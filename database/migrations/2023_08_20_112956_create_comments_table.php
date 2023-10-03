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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // commentable_id, commentable_type
            $table->morphs('commentable');
            $table->foreignId('user_id')->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('user_name');
            $table->text('content');
            $table->enum('status', ['pending', 'published']);
            $table->string('ip_address', 15);
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
