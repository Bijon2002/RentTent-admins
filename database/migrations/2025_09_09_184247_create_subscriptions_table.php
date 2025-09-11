<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id(); // subscription id
            $table->unsignedBigInteger('user_id'); // FK to users.user_id
            $table->unsignedBigInteger('vendor_id'); // FK to food_menu.menu_id
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->json('payment_info')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('menu_id')->on('food_menu')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
