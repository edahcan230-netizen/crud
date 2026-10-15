<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiants;

class EtudiantController extends Controller
{
    //
    public function liste_etudiants()
    {
        $etudiants = Etudiants::paginate(4);
        return view('etudiants.liste', compact('etudiants'));
       } 


    public function ajouter_etudiant()
        {
            return view('etudiants.ajouter');
    }

    public function ajouter_etudiant_traitement(Request $request)
        {
            // Validation des données du formulaire
            $request->validate([
                'Nom' => 'required |string|max:255',
                'Prenom' => 'required |string|max:255',
                'Classe' => 'required|string|max:255',
            ]);

            // Création d'un nouvel étudiant 
            $etudiant = new Etudiants();
            $etudiant->Nom = $request->input('Nom');
            $etudiant->Prenom = $request->input('Prenom');
            $etudiant->Classe = $request->input('Classe');
            $etudiant->save();

            // Redirection vers la liste des étudiants avec un message de succès
            return redirect('/ajouter')->with('status', 'L\'étudiant ajouté avec succès !');
        }

        public function update_etudiants($id){
            $etudiant = Etudiants::find($id);
            return view('etudiants.update', compact('etudiant'));
        }

        public function update_etudiant_traitement(Request $request){
            // Validation des données du formulaire
            $request->validate([
                'Nom' => 'required |string|max:255',
                'Prenom' => 'required |string|max:255',
                'Classe' => 'required|string|max:255',
            ]);

            // Récupération de l'étudiant à mettre à jour 
            $etudiant = Etudiants::find($request->input('id'));
            if ($etudiant) {
                $etudiant->Nom = $request->Nom;
                $etudiant->Prenom = $request->Prenom;
                $etudiant->Classe = $request->Classe;
                $etudiant->update();

                // Redirection vers la liste des étudiants avec un message de succès
                return redirect('/etudiants')->with('status', 'L\'étudiant a été modifié avec succès !');
            } else {
                // Si l'étudiant n'existe pas, rediriger vers la liste avec un message d'erreur
                return redirect('/etudiants')->with('status', 'Étudiant non trouvé.');
            } 
        }

        public function delete_etudiant($id){ 
            $etudiant = Etudiants::find($id);
            if ($etudiant) {
                $etudiant->delete();
                return redirect('/etudiants')->with('status', 'L\'étudiant a été supprimé avec succès !');
            } else {
                return redirect('/etudiants')->with('status', 'Étudiant non trouvé.');
            }
        }
    }