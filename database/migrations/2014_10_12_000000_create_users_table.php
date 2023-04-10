<?php

use App\Constants\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('image')->nullable();
            $table->string('bio')->nullable();
            $table->string('message')->nullable();
            $table->string('user_code')->default(random_int(000000000000000000,999999999999999999))->unique();
            $table->string('country')->nullable();
            $table->string('type')->default(UserType::CLIENT);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_active_code')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
