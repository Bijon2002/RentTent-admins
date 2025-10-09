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
        Schema::table('boarding_list', function (Blueprint $table) {
            // Payment & Booking
            if (!Schema::hasColumn('boarding_list', 'advance_percent')) {
                $table->decimal('advance_percent', 5, 2)->default(10.00)->after('monthly_rent');
            }
            if (!Schema::hasColumn('boarding_list', 'is_refundable')) {
                $table->boolean('is_refundable')->default(false)->after('advance_percent');
            }

            // Room Details
            if (!Schema::hasColumn('boarding_list', 'gender_preference')) {
                $table->enum('gender_preference', ['male', 'female', 'any'])->default('any')->after('room_type');
            }
            if (!Schema::hasColumn('boarding_list', 'room_size')) {
                $table->unsignedSmallInteger('room_size')->nullable()->after('room_type');
            }

            // Facilities
            if (!Schema::hasColumn('boarding_list', 'wifi')) {
                $table->boolean('wifi')->default(false)->after('gender_preference');
            }
            if (!Schema::hasColumn('boarding_list', 'parking')) {
                $table->boolean('parking')->default(false)->after('wifi');
            }
            if (!Schema::hasColumn('boarding_list', 'laundry')) {
                $table->boolean('laundry')->default(false)->after('parking');
            }
            if (!Schema::hasColumn('boarding_list', 'attached_bathroom')) {
                $table->boolean('attached_bathroom')->default(false)->after('laundry');
            }
            if (!Schema::hasColumn('boarding_list', 'furnished')) {
                $table->boolean('furnished')->default(false)->after('attached_bathroom');
            }

            // Verification & Trust
            if (!Schema::hasColumn('boarding_list', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('furnished');
            }
            if (!Schema::hasColumn('boarding_list', 'trust_score')) {
                $table->unsignedInteger('trust_score')->default(0)->after('is_verified');
            }
            if (!Schema::hasColumn('boarding_list', 'property_doc_image')) {
                $table->string('property_doc_image')->nullable()->after('trust_score');
            }
            if (!Schema::hasColumn('boarding_list', 'police_report_image')) {
                $table->string('police_report_image')->nullable()->after('property_doc_image');
            }

            // Availability
            if (!Schema::hasColumn('boarding_list', 'availability_status')) {
                $table->enum('availability_status', ['available','booked'])->default('available')->after('is_approved');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boarding_list', function (Blueprint $table) {
            $table->dropColumn([
                'advance_percent', 'is_refundable', 'gender_preference', 'room_size',
                'wifi', 'parking', 'laundry', 'attached_bathroom', 'furnished',
                'is_verified', 'trust_score', 'property_doc_image', 'police_report_image',
                'availability_status'
            ]);
        });
    }
};
