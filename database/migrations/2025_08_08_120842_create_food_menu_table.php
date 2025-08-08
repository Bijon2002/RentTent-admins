<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_menu', function (Blueprint $table) {
            $table->id('menu_id');                     // PK
            $table->unsignedBigInteger('user_id');     // FK vendor
            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->string('name');                     // Menu name
            $table->enum('food_type', ['breakfast', 'lunch', 'dinner']);
            $table->enum('preference', ['veg', 'non_veg', 'both']);
            $table->decimal('monthly_fee', 8, 2);
            $table->string('image_url')->nullable();   // Food image
            $table->boolean('approved')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->float('rating')->default(0);       // Avg rating
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_menu');
    }
};
