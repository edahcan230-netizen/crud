<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    //

      protected $fillable = [
        'Nom',
        'Prenom',
        'Classe',
    ];
}
