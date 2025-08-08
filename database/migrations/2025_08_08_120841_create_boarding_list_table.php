<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boarding_list', function (Blueprint $table) {
            $table->id('boarding_id');               // PK
            $table->unsignedBigInteger('user_id');  // FK to users (provider)
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('monthly_rent', 8, 2);
            $table->text('privacy_policy');
            $table->enum('room_type', ['single', 'shared', 'family']);
            $table->boolean('is_food_included');
            $table->boolean('is_approved');
            $table->unsignedTinyInteger('police_zone_rating');  // 1-5 rating
            $table->date('posted_date');
            $table->timestamps();

            // FK referencing user_id in users table
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boarding_list');
    }
};


