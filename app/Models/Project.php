<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false; // Ajoute ceci pour dire à Eloquent de ne pas s'occuper des timestamps

    protected $table = 'project'; // Indiquez le nom de la table réelle ici

    // Définissez les colonnes qui peuvent être remplies via des formulaires
    protected $fillable = [
        'title', // Nom du projet
        'mainPicture', // Image principale
        'summary', // Résumé du projet
        'idCat', // ID de la catégorie du projet
        'mainDescription', // Description principale
        'secondDescription', // Description secondaire
        'githubLink', // Lien GitHub
        // Ajoutez d'autres colonnes selon les besoins
    ];

    /**
     * Relation avec la catégorie.
     */

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCat', 'id');
    }

    public function projectPictures()
    {
        return $this->hasMany(ProjectPicture::class, 'idProject', 'id');
    }

    // Ajoutez d'autres méthodes de relation ou de logique métier ici si nécessaire
}
