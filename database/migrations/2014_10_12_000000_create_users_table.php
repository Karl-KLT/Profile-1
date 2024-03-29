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
            $table->longText('cover_image')->nullable();
            $table->string('bio')->nullable();

            // contact info
            $table->mediumText('phoneNumber')->nullable();
            $table->mediumText('facebook')->nullable();
            $table->mediumText('instagram')->nullable();
            $table->mediumText('twitter')->nullable();
            $table->mediumText('linkedIn')->nullable();
            $table->mediumText('website')->nullable();
            $table->mediumText('location')->nullable();
            // end contact info

            $table->string('message')->nullable();
            $table->string('user_code')->nullable();
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
