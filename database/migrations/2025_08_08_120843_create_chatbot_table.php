<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot', function (Blueprint $table) {
            $table->id('chat_id');
            $table->unsignedBigInteger('user_id'); // FK to users

            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade');

            $table->text('message');
            $table->text('bot_response');
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot');
    }
};
