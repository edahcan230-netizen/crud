<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['etudiant_id', 'matiere_id', 'n1', 'n2', 'n3'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, 'etudiant_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function moyenne()
{
    $total = ($this->n1 ?? 0) + ($this->n2 ?? 0) + ($this->n3 ?? 0);
    return round($total / 3, 2);
}
}