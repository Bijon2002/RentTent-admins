<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');           // PK
            $table->unsignedBigInteger('user_id'); // FK reviewer

            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->enum('target_type', ['boarding', 'menu', 'user']);
            $table->unsignedBigInteger('target_id');
            $table->unsignedTinyInteger('rating');  // stars 1-5
            $table->text('review')->nullable();
            $table->timestamp('posted_at');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
