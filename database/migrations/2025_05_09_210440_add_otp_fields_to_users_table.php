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
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp')->nullable(); // To store OTP
            $table->boolean('is_verified')->default(false); // To store verification status
            $table->timestamp('otp_expiration')->nullable(); // To store OTP expiration time
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('otp');
            $table->dropColumn('is_verified');
            $table->dropColumn('otp_expiration');
        });
    }
};
