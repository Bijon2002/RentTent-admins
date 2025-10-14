<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('nic_number');
            $table->enum('role', ['finder', 'provider', 'vendor']);
            $table->text('profile_pic')->nullable();
            $table->text('nic_image')->nullable(); // New NIC upload field
            $table->string('location');
            $table->string('password');
            $table->enum('verification_status', ['Pending', 'Verified', 'Manual Review', 'Rejected'])
                  ->default('Pending'); // New verification status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
