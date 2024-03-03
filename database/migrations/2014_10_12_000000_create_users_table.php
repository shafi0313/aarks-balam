<?php

use App\Constants\IsActive;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email', 64)->unique();
            $table->string('user_name', 32)->unique()->nullable();
            $table->unsignedTinyInteger('role')->default(0)->comment('1:Admin');
            $table->unsignedTinyInteger('gender')->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active', [IsActive::ACTIVE, IsActive::INACTIVE])->default(IsActive::ACTIVE);
            $table->boolean('removable')->default(1);
            $table->string('image', 32)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
