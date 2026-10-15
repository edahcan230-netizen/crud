<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatiereController extends Controller
{
    public function index()
{
    $matieres = Matiere::with('classe')->orderBy('nom_matiere')->get()->groupBy('nom_matiere');
    return view('admin.matieres.liste', compact('matieres'));
}

    public function create()
    {
        $classes = Classe::all();
        return view('admin.matieres.ajouter', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_matiere' => [
                'required', 'string', 'max:255',
                Rule::unique('matieres')->where(fn ($query) => $query->where('classe_id', $request->classe_id)),
            ],
            'classe_id' => 'required|exists:classes,id',
        ], [
            'nom_matiere.unique' => 'Cette matière existe déjà pour cette classe.',
        ]);

        Matiere::create([
            'nom_matiere' => $request->input('nom_matiere'),
            'classe_id' => $request->input('classe_id'),
        ]);

        return redirect()->route('admin.matieres.index')->with('status', 'Matière ajoutée avec succès !');
    }

    public function edit($id)
    {
        $matiere = Matiere::findOrFail($id);
        $classes = Classe::all();
        return view('admin.matieres.modifier', compact('matiere', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $matiere = Matiere::findOrFail($id);

        $request->validate([
            'nom_matiere' => [
                'required', 'string', 'max:255',
                Rule::unique('matieres')->where(fn ($query) => $query->where('classe_id', $request->classe_id))->ignore($matiere->id),
            ],
            'classe_id' => 'required|exists:classes,id',
        ], [
            'nom_matiere.unique' => 'Cette matière existe déjà pour cette classe.',
        ]);

        $matiere->nom_matiere = $request->input('nom_matiere');
        $matiere->classe_id = $request->input('classe_id');
        $matiere->save();

        return redirect()->route('admin.matieres.index')->with('status', 'Matière modifiée avec succès !');
    }

    public function destroy($id)
    {
        Matiere::findOrFail($id)->delete();
        return redirect()->route('admin.matieres.index')->with('status', 'Matière supprimée avec succès !');
    }
}