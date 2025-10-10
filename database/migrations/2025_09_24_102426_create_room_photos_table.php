<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_photos', function (Blueprint $table) {
            $table->id('photo_id');             // PK
            $table->unsignedBigInteger('boarding_id');  // FK
            $table->text('image_url');
            $table->boolean('is_main')->default(false);
            $table->timestamps();


            $table->foreign('boarding_id')->references('boarding_id')->on('boarding_list')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_photos');
    }
};
