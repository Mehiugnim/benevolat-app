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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 191); // Utiliser 191 caractères pour éviter les problèmes de clé
            $table->string('token', 32); // Réduire la longueur ici
            $table->timestamp('created_at')->nullable();

            // Ajouter un index unique sur l'email et le token
            $table->unique(['email', 'token']); // Cela permet d'avoir plusieurs tokens pour le même email
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};