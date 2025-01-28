<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class BackOfficeUtilisateurController extends Controller
{
     // Methode pour afficher la page Mon Profil
     public function index()
     {  
        $utilisateurs = Utilisateur::all()->toArray();
        return view('BackOffice.backOffice_Utilisateur', compact('utilisateurs'));
     }
     
     // methode pour afficher la page Inscription
     public function create()
     {

     }
     
     // Créer l'inscription et l'enregistrer dans la BDD 
     public function store(Request $request)
     {

     }
 
     // Afficher la page qui permet de modifier le profil
     public function edit($identifiant)
     {

 
     }
 
     // Lancer l'enregistrement de la modification du profil
     public function update(Request $request, $identifiant)
     {

 
     }
     
     // Fonction pour Soft-Delete un Utilisateur
     public function destroy( $utilisateur)
     {
        $utilisateur = Utilisateur::find($utilisateur);
        $utilisateur->delete();
        return redirect()->route('admin_Utilisateur_Index')->with('success','Actualité supprimé');
     }
 
}
