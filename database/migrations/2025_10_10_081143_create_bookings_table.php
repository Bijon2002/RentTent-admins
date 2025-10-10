<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // bookings table PK
            $table->unsignedBigInteger('user_id'); // links to users.user_id
            $table->unsignedBigInteger('boarding_id'); // links to boarding_list.boarding_id
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['reserved', 'booked'])->default('reserved');
            $table->timestamp('reserved_at')->nullable();
            $table->timestamp('booked_at')->nullable();
            $table->boolean('is_non_refundable')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('boarding_id')->references('boarding_id')->on('boarding_list')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
