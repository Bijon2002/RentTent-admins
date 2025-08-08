<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // admin name
            $table->string('email')->unique();    // unique email
            $table->string('password');           // hashed password
            $table->rememberToken();              // remember me token
            $table->timestamps();                 // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
