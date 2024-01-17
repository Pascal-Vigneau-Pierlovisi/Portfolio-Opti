<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProjectPicture extends Model
{

    use HasFactory;

    public $timestamps = false; // Ajoute ceci pour dire à Eloquent de ne pas s'occuper des timestamps

    protected $table = 'project_picture'; // Indiquez le nom de la table réelle ici
    protected $fillable = ['picture', 'idProject'];

    // ... autres méthodes et relations ...
}

?>