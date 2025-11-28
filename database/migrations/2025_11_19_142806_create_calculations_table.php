<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('weight', 5, 1);
            $table->decimal('bodyfat', 4, 1);
            $table->decimal('activity', 5, 3);
            $table->integer('deficit');
            $table->integer('calories');
            $table->integer('proteins');
            $table->integer('fats');
            $table->integer('carbs');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};