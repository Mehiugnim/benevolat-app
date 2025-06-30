<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProjetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifie si un utilisateur existe avec l'ID 1
        $organisation = DB::table('utilisateurs')->find(1);

        if (!$organisation) {
            // Insère un utilisateur fictif
            DB::table('utilisateurs')->insert([
                'id' => 1,
                'nom_utilisateur' => 'Admin',
                'prenom_utilisateur' => 'Test',
                'email_utilisateur' => 'admin@example.com',
                'mot_de_pass_utilisateur' => bcrypt('password'),
                'type_utilisateur' => 'Organisation',
                'statut_utilisateur' => 'Actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertion des projets de démonstration
        DB::table('projets')->insert([
            [
                'titre_projet' => 'Nettoyage des plages',
                'description_projet' => 'Projet environnemental pour nettoyer les plages de la ville.',
                'type_projet' => 'Environnement',
                'competences_requises' => 'Travail en équipe, ponctualité',
                'lieu_projet' => 'Abidjan',
                'debut_projet' => Carbon::now()->addDays(3),
                'fin_projet' => Carbon::now()->addDays(10),
                'nombre_benevoles' => 8,
                'etat_projet' => 'Ouvert',
                'id_organisation' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre_projet' => 'Soutien scolaire en ligne',
                'description_projet' => 'Aider des enfants à faire leurs devoirs chaque soir via Zoom.',
                'type_projet' => 'Éducation',
                'competences_requises' => 'Pédagogie, patience',
                'lieu_projet' => 'Virtuel',
                'debut_projet' => Carbon::now()->addDays(1),
                'fin_projet' => Carbon::now()->addDays(30),
                'nombre_benevoles' => 5,
                'etat_projet' => 'Ouvert',
                'id_organisation' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
