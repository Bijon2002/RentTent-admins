<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id(); // primary key
            $table->unsignedBigInteger('user_id'); // who gave the rating
            $table->unsignedBigInteger('boarding_id'); // which boarding is rated
            $table->tinyInteger('rating')->default(5); // 1-5 stars
            $table->text('review')->nullable(); // review text
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('boarding_id')->references('boarding_id')->on('boarding_list')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
