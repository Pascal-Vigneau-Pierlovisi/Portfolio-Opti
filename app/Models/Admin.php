<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'user'; // Indiquez le nom de la table réelle ici

    protected $guarded = [];

    // You can add more fields if you need
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Make sure to hide the password and remember token
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Your custom methods here
}
