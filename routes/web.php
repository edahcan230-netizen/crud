<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantProfilController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/etudiant/{id}/valider', [AdminController::class, 'validerEtudiant'])->name('admin.valider');
    Route::post('/admin/etudiant/{id}/rejeter', [AdminController::class, 'rejeterEtudiant'])->name('admin.rejeter');
    Route::delete('/admin/etudiant/{id}', [AdminController::class, 'supprimerEtudiant'])->name('admin.etudiant.supprimer');

    // Classes
Route::get('/admin/classes', [ClasseController::class, 'index'])->name('admin.classes.index');
Route::get('/admin/classes/ajouter', [ClasseController::class, 'create'])->name('admin.classes.create');
Route::post('/admin/classes', [ClasseController::class, 'store'])->name('admin.classes.store');
Route::get('/admin/classes/{id}/modifier', [ClasseController::class, 'edit'])->name('admin.classes.edit');
Route::put('/admin/classes/{id}', [ClasseController::class, 'update'])->name('admin.classes.update');
Route::delete('/admin/classes/{id}', [ClasseController::class, 'destroy'])->name('admin.classes.destroy');

// Matières
Route::get('/admin/matieres', [MatiereController::class, 'index'])->name('admin.matieres.index');
Route::get('/admin/matieres/ajouter', [MatiereController::class, 'create'])->name('admin.matieres.create');
Route::post('/admin/matieres/ajouter', [MatiereController::class, 'store'])->name('admin.matieres.store');
Route::get('/admin/matieres/{id}/modifier', [MatiereController::class, 'edit'])->name('admin.matieres.edit');
Route::put('/admin/matieres/{id}', [MatiereController::class, 'update'])->name('admin.matieres.update');
Route::delete('/admin/matieres/{id}', [MatiereController::class, 'destroy'])->name('admin.matieres.destroy');

// Notes
Route::get('/admin/notes', [NoteController::class, 'index'])->name('admin.notes.index');
Route::get('/admin/notes/ajouter', [NoteController::class, 'create'])->name('admin.notes.create');
Route::post('/admin/notes/ajouter', [NoteController::class, 'store'])->name('admin.notes.store');
Route::get('/admin/notes/{id}/modifier', [NoteController::class, 'edit'])->name('admin.notes.edit');
Route::put('/admin/notes/{id}', [NoteController::class, 'update'])->name('admin.notes.update');
Route::delete('/admin/notes/{id}', [NoteController::class, 'destroy'])->name('admin.notes.destroy');
});

    Route::middleware(['auth', 'admin', 'super_admin'])->group(function () {
    Route::get('/admin/gerer-admins', [AdminController::class, 'gererAdmins'])->name('admin.gerer-admins');
    Route::post('/admin/gerer-admins/creer', [AdminController::class, 'creerAdmin'])->name('admin.creer-admin');
    Route::post('/admin/gerer-admins/{id}/supprimer', [AdminController::class, 'supprimerAdmin'])->name('admin.supprimer-admin');

});

Route::get('/etudiants', [EtudiantController::class, 'liste_etudiants'])->name('etudiants.liste');
Route::get('/ajouter', [EtudiantController::class, 'ajouter_etudiant'])->name('etudiants.ajouter');
Route::post('/ajouter', [EtudiantController::class, 'ajouter_etudiant_traitement'])->name('etudiants.store');
Route::get('/etudiants/{id}/modifier', [EtudiantController::class, 'update_etudiants'])->name('etudiants.modifier');
Route::post('/etudiants/update', [EtudiantController::class, 'update_etudiant_traitement'])->name('etudiants.update');
Route::get('/etudiants/{id}/supprimer', [EtudiantController::class, 'delete_etudiant'])->name('etudiants.supprimer');

Route::middleware('auth')->group(function () {
    Route::get('/etudiant/informations', [EtudiantProfilController::class, 'informations'])->name('etudiant.informations');
    Route::post('/etudiant/informations', [EtudiantProfilController::class, 'informations_traitement'])->name('etudiant.informations.store');
    Route::get('/etudiant/dashboard/infos', [EtudiantProfilController::class, 'infos'])->name('etudiant.dashboard.infos');
});

Route::middleware('auth')->group(function () {
    Route::get('/etudiant/informations', [EtudiantProfilController::class, 'informations'])->name('etudiant.informations');
    Route::post('/etudiant/informations', [EtudiantProfilController::class, 'informations_traitement'])->name('etudiant.informations.store');
    Route::get('/etudiant/dashboard', [EtudiantProfilController::class, 'dashboard'])->name('etudiant.dashboard');
    Route::get('/etudiant/modifier', [EtudiantProfilController::class, 'modifier'])->name('etudiant.modifier');
    Route::post('/etudiant/modifier', [EtudiantProfilController::class, 'modifier_traitement'])->name('etudiant.modifier.store');
    Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('/admin/profil', [AdminController::class, 'profil_update'])->name('admin.profil.update');
});

require __DIR__.'/auth.php';
