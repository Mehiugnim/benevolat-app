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
    Schema::create('projets', function (Blueprint $table) {
        $table->id();
        $table->string('titre_projet', 100);
        $table->text('description_projet')->nullable();
        $table->string('type_projet', 50)->nullable();
        $table->string('competences_requises', 200)->nullable();
        $table->string('lieu_projet', 100)->nullable();
        $table->dateTime('debut_projet');
        $table->dateTime('fin_projet');
        $table->integer('nombre_benevoles');
        $table->enum('etat_projet', ['Ouvert', 'En cours', 'Terminé'])->default('Ouvert');
        $table->foreignId('id_organisation')->constrained('utilisateurs')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
