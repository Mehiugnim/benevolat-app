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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',64)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->string('image',100)->nullable();
            $table->string('designation',100)->nullable();
            $table->string('mobile',100)->nullable();
            $table->integer('marks')->Default(1);
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
