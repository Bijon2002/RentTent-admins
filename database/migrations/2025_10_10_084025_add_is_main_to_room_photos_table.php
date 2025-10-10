<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('room_photos', function (Blueprint $table) {
        if (!Schema::hasColumn('room_photos', 'is_main')) {
            $table->boolean('is_main')->default(false)->after('image_url');
        }
    });
}

public function down(): void
{
    Schema::table('room_photos', function (Blueprint $table) {
        $table->dropColumn('is_main');
    });
}

};
