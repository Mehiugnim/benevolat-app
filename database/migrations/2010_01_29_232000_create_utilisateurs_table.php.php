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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_utilisateur', 50);
            $table->string('prenom_utilisateur', 50)->nullable();
            $table->string('email_utilisateur', 100)->unique();
            $table->string('mot_de_pass_utilisateur', 255)->nullable();
            $table->enum('type_utilisateur', ['bénévole', 'Organisation', 'Administration'])->default('bénévole');
            $table->enum('statut_utilisateur', ['Actif', 'Inactif'])->default('Actif');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
