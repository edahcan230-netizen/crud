<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiants;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
{
    $notes = Note::with(['etudiant', 'matiere'])->get()->groupBy('etudiant_id');
    return view('admin.notes.liste', compact('notes'));
}

    public function create()
{
    $data = Classe::with('matieres')->get()->map(function ($classe) {
        return [
            'id' => $classe->id,
            'nom' => $classe->nom_classe,
            'matieres' => $classe->matieres->map(fn ($m) => ['id' => $m->id, 'nom' => $m->nom_matiere])->values(),
            'etudiants' => Etudiants::where('Classe', $classe->nom_classe)->get(['id', 'Nom', 'Prenom'])->values(),
        ];
    });

    $existingNotes = Note::get(['etudiant_id', 'matiere_id'])->map(fn ($n) => $n->etudiant_id . '-' . $n->matiere_id);

    return view('admin.notes.ajouter', ['data' => $data, 'existingNotes' => $existingNotes]);
}

    public function store(Request $request)
{
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
        'matiere_id' => 'required|exists:matieres,id',
        'n1' => 'nullable|numeric|min:0|max:20',
        'n2' => 'nullable|numeric|min:0|max:20',
        'n3' => 'nullable|numeric|min:0|max:20',
    ]);

    $existe = Note::where('etudiant_id', $request->etudiant_id)
        ->where('matiere_id', $request->matiere_id)
        ->exists();

    if ($existe) {
        return back()->withErrors(['matiere_id' => 'Cette matière a déjà une note pour cet étudiant.']);
    }

    Note::create($request->only(['etudiant_id', 'matiere_id', 'n1', 'n2', 'n3']));

    return redirect()->route('admin.notes.index')->with('status', 'Note ajoutée avec succès !');
}

    public function edit($id)
    {
        $note = Note::with(['etudiant', 'matiere'])->findOrFail($id);
        return view('admin.notes.modifier', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $request->validate([
            'n1' => 'nullable|numeric|min:0|max:20',
            'n2' => 'nullable|numeric|min:0|max:20',
            'n3' => 'nullable|numeric|min:0|max:20',
        ]);

        $note->n1 = $request->input('n1');
        $note->n2 = $request->input('n2');
        $note->n3 = $request->input('n3');
        $note->save();

        return redirect()->route('admin.notes.index')->with('status', 'Note modifiée avec succès !');
    }

    public function destroy($id)
    {
        Note::findOrFail($id)->delete();
        return redirect()->route('admin.notes.index')->with('status', 'Note supprimée avec succès !');
    }
}