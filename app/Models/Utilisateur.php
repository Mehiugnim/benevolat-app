<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs'; // indispensable car le nom n'est pas au pluriel anglais par défaut

    protected $fillable = [
        'nom_utilisateur',
        'prenom_utilisateur',
        'email_utilisateur',
        'mot_de_pass_utilisateur',
        'type_utilisateur',
        'statut_utilisateur',
    ];
}
