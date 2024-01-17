<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false; // Ajoute ceci pour dire à Eloquent de ne pas s'occuper des timestamps

    protected $table = 'project_categorie'; // Indiquez le nom de la table réelle ici

    // Définissez les colonnes qui peuvent être remplies via des formulaires
    protected $fillable = [
        'libelle', // Le nom de la catégorie
        // Vous pouvez ajouter d'autres attributs si nécessaire
    ];

    /**
     * Relation avec les projets.
     */
    // Dans le modèle Category
    public function projects()
    {
        return $this->hasMany(Project::class); // Assure-toi que le nom de la classe est correct et que tu utilises les bonnes clés étrangères si nécessaire
    }

    // Ajoutez d'autres méthodes de relation ou de logique métier ici si nécessaire
}
