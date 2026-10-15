<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   
    public function validerEtudiant($id)
    {
        $etudiant = Etudiants::findOrFail($id);
        $etudiant->statut = 'valide';
        $etudiant->save();

        return redirect()->back()->with('status', 'Étudiant validé avec succès !');
    }

    public function rejeterEtudiant($id)
    {
        $etudiant = Etudiants::findOrFail($id);
        $etudiant->statut = 'rejete';
        $etudiant->save();

        return redirect()->back()->with('status', 'Étudiant rejeté.');
    }

    public function profil()
{
    return view('admin.profil');
}

public function profil_update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    return redirect()->route('admin.profil')->with('status', 'Profil mis à jour avec succès !');
}

public function gererAdmins()
{
    $admins = \App\Models\User::where('role', 'admin')->get();
    return view('admin.gerer_admins', compact('admins'));
}

public function creerAdmin(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    \App\Models\User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'role' => 'admin',
    ]);

    return redirect()->route('admin.gerer-admins')->with('status', 'Nouvel administrateur créé avec succès !');
}

public function voirEtudiant($id)
{
    $etudiant = Etudiants::findOrFail($id);
    return view('admin.etudiant_details', compact('etudiant'));
}

public function supprimerEtudiant($id)
{
    $etudiant = Etudiants::findOrFail($id);
    $etudiant->delete();

    return redirect()->route('admin.dashboard')->with('status', 'Étudiant supprimé avec succès.');
}

public function supprimerAdmin($id)
{
    $user = \App\Models\User::findOrFail($id);

    if ($user->is_super_admin) {
        return redirect()->route('admin.gerer-admins')->with('status', 'Impossible de supprimer le super-administrateur.');
    }

    $user->delete();

    return redirect()->route('admin.gerer-admins')->with('status', 'Administrateur supprimé avec succès.');
}
public function dashboard()
{
    $etudiants = Etudiants::all();
    $totalInscrits = $etudiants->count();
    $totalValides = $etudiants->where('statut', 'valide')->count();
    $totalRejetes = $etudiants->where('statut', 'rejete')->count();
    $totalEnAttente = $etudiants->where('statut', 'en_attente')->count();

    return view('admin.dashboard', compact('etudiants', 'totalInscrits', 'totalValides', 'totalRejetes', 'totalEnAttente'));
}
}