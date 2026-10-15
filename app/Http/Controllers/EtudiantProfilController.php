<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use Illuminate\Http\Request;

class EtudiantProfilController extends Controller
{
   public function informations()
{
    $classes = \App\Models\Classe::all();
    $prefillNom = old('Nom', session('reg_nom', ''));
    $prefillPrenom = old('Prenom', session('reg_prenom', ''));
    return view('etudiants.informations', compact('classes', 'prefillNom', 'prefillPrenom'));
}

    public function informations_traitement(Request $request)
    {
        $request->validate([
    'Nom' => 'required|string|max:255',
    'Prenom' => 'required|string|max:255',
    'Classe' => 'required|string|max:255',
    'Telephone' => 'required|digits:10',
]);

        $etudiant = new Etudiants();
        $etudiant->Nom = $request->input('Nom');
        $etudiant->Prenom = $request->input('Prenom');
        $etudiant->Classe = $request->input('Classe');
        $etudiant->Telephone = $request->input('Telephone');
        $etudiant->statut = 'en_attente';
        $etudiant->user_id = auth()->id();
        $etudiant->save();

       return redirect()->route('etudiant.dashboard')->with('status', 'Vos informations ont été enregistrées ! En attente de validation.');
    }

  public function dashboard()
{
    $etudiant = Etudiants::where('user_id', auth()->id())->first();

    $notes = collect();
    if ($etudiant) {
        $notes = \App\Models\Note::with('matiere')
            ->where('etudiant_id', $etudiant->id)
            ->get();
    }

    return view('etudiants.dashboard', compact('etudiant', 'notes'));
}

public function modifier()
{
    $etudiant = Etudiants::where('user_id', auth()->id())->firstOrFail();
    $classes = \App\Models\Classe::all();
    return view('etudiants.informations_edit', compact('etudiant', 'classes'));
}

public function infos()
{
    $etudiant = Etudiants::where('user_id', auth()->id())->firstOrFail();
    return view('etudiants.mes_informations', compact('etudiant'));
}

public function modifier_traitement(Request $request)
{
    $etudiant = Etudiants::where('user_id', auth()->id())->firstOrFail();

    $request->validate([
        'Nom' => 'required|string|max:255',
        'Prenom' => 'required|string|max:255',
        'Classe' => 'required|string|max:255',
        'Telephone' => 'required|string|max:20',
    ]);

    $etudiant->Nom = $request->input('Nom');
    $etudiant->Prenom = $request->input('Prenom');
    $etudiant->Classe = $request->input('Classe');
    $etudiant->Telephone = $request->input('Telephone');
    $etudiant->save();

    return redirect()->route('etudiant.dashboard')->with('status', 'Vos informations ont été mises à jour !');
}
}