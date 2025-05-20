<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_playtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->float('hours_played');
            $table->timestamp('played_at');
            $table->timestamps();

            $table->unique(['user_id', 'game_id', 'played_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_playtimes');
    }
}; 