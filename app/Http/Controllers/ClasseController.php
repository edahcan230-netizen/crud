<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('admin.classes.liste', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.ajouter');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom_classe' => 'required|string|max:255',
    ]);

    $existe = Classe::whereRaw('LOWER(nom_classe) = ?', [strtolower($request->nom_classe)])->exists();
    if ($existe) {
        return back()->withErrors(['nom_classe' => 'Cette classe existe déjà.'])->withInput();
    }

    Classe::create(['nom_classe' => $request->input('nom_classe')]);

    return redirect()->route('admin.classes.index')->with('status', 'Classe ajoutée avec succès !');
}

    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        return view('admin.classes.modifier', compact('classe'));
    }

    public function update(Request $request, $id)
{
    $classe = Classe::findOrFail($id);

    $request->validate([
        'nom_classe' => 'required|string|max:255',
    ]);

    $existe = Classe::whereRaw('LOWER(nom_classe) = ?', [strtolower($request->nom_classe)])
        ->where('id', '!=', $id)
        ->exists();
    if ($existe) {
        return back()->withErrors(['nom_classe' => 'Cette classe existe déjà.'])->withInput();
    }

    $classe->nom_classe = $request->input('nom_classe');
    $classe->save();

    return redirect()->route('admin.classes.index')->with('status', 'Classe modifiée avec succès !');
}

    public function destroy($id)
    {
        Classe::findOrFail($id)->delete();
        return redirect()->route('admin.classes.index')->with('status', 'Classe supprimée avec succès !');
    }
}