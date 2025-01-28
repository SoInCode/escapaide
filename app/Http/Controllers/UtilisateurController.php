<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Utilisateur;
use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\frontOffice_Utilisateur_Request;
use App\Http\Requests\frontOffice_Utilisateur_Update_Request;
use App\Http\Requests\Auth\LoginRequest;
use Exception;

class UtilisateurController extends Controller
{
    // Methode pour afficher la page Mon Profil
    public function index($identifiant)
    {
        // Condition qui vérifie si l'utilisateur Auth est bien le meme que celui de la page consulté
        if (auth()->user()->identifiant !== $identifiant) {
            abort(403, 'Accès interdit.');
        }

        $departements = Departement::all();
        $profil = 1 ;
        $id_user = Utilisateur::where('identifiant', $identifiant)->select('id_user')->first();
        $threads = Thread::where('id_user', $id_user->id_user)->get();


        if (is_null($threads))
        {
            return view('FrontOffice.frontOffice_MonProfil',compact('departements','utilisateur','profil'));
        }

        $listeThreads = [];
        foreach($threads as $thread){
            $thread->category_id = Category::where('id', $thread->category_id)->select('name')->first();
            $listeThreads[] = $thread;
        }
        
        $utilisateur = Utilisateur::where('identifiant', $identifiant)->select('identifiant','nom','prenom','email','numero_de_telephone','age','localisation','centres_d_interet','type_aides','accessibilite_specifique')->first();
        return view('FrontOffice.frontOffice_MonProfil',compact('departements','utilisateur','profil','listeThreads'));
    }
    
    // methode pour afficher la page Inscription
    public function create()
    {
        $departements = Departement::all();
        return view('FrontOffice.frontOffice_Inscription',compact('departements'));
    }
    
    // Créer l'inscription et l'enregistrer dans la BDD 
    public function store(frontOffice_Utilisateur_Request $request)
    {
        $validatedData = $request->validated();
        $validatedData['mot_de_passe'] = Hash::make($validatedData['mot_de_passe']);
        
        Utilisateur::create($validatedData);
        return redirect()->route('homepage.index')->with('success','Nouveau Compte crée');
    }

    // Afficher la page qui permet de modifier le profil
    public function edit($identifiant)
    {
        // Condition qui vérifie si l'utilisateur Auth est bien le meme que celui de la page consulté
        if (auth()->user()->identifiant !== $identifiant) {
            abort(403, 'Accès interdit.');
        }

        $departements = Departement::all();
        $utilisateur = Utilisateur::where('identifiant', $identifiant)->select('id_user','identifiant','nom','prenom','email','numero_de_telephone','age','localisation','centres_d_interet','type_aides','accessibilite_specifique')->first();
        return view('FrontOffice.frontOffice_Modification',compact('departements','utilisateur'));

    }

    // Lancer l'enregistrement de la modification du profil
    public function update(Request $request, $identifiant)
    {

        $utilisateur = Utilisateur::where('id_user', $identifiant)->first();


        $validatedData = $request->validate([
            //"identifiant" => 'required|unique:utilisateurs' . $utilisateur->id, // PERMET D'IGNORER L'EMAIL DE L'UTILISATEUR ACTUELLE AFIN D'EVITER LES CONFLIE AVEC LUI MEME
            "nom" => 'required',
            "prenom" => 'required',
            //"mot_de_passe" => 'required',
            "email" => 'required|unique:utilisateurs,email,' . $utilisateur->id_user . ',id_user', // PERMET D'IGNORER L'EMAIL DE L'UTILISATEUR ACTUELLE AFIN D'EVITER LES CONFLIE AVEC LUI MEME
            "numero_de_telephone" => 'required|unique:utilisateurs,numero_de_telephone,' . $utilisateur->id_user . ',id_user',
            "age" => 'required',
            "localisation" => 'required',
            "centres_d_interet" => 'required',
            "type_aides" => 'required',
            "accessibilite_specifique" => 'required',
        ]);

        $user = Utilisateur::find($identifiant);

        try{
            $user->update($validatedData);
            $info = "vos modification ont bien été enregistrée";
        }
        catch(Exception $e){
            $info = "Erreur lors de l'enregistrement de vos modification";
        }
        return redirect()->route('homepage.index')->with('status',$info);

    }
    

    public function destroy( $identifiant)
    {
        // Condition qui vérifie si l'utilisateur Auth est bien le meme que celui de la page consulté
        if (auth()->user()->identifiant !== $identifiant) {
            abort(403, 'Accès interdit.');
        }

        $identifiant = Utilisateur::find($identifiant);


        // Deconnecter l'utilisateur
        Auth::logout();
        $identifiant->delete();

        return redirect()->route('homepage.index')->with('success','Profil Supprimé');
    }

    // Methode pour afficher la page de connection
    public function pageConnexion()
    {
        $departements = Departement::all();
        return view('FrontOffice.frontOffice_Connexion',compact('departements'));
    }

    // Methode pour lancer la connexion et ce connecter
    public function connexion(Request $request)
    {

        $request->validate([
            'identifiant' => 'required|string',
            'mot_de_passe' => 'required|string',
        ]);

        $identifiant = $request->identifiant;
        $mot_de_passe = $request->mot_de_passe;

        $user = Utilisateur::where('identifiant', $identifiant)->first();

        if($user && Hash::check($mot_de_passe, $user->mot_de_passe))
        {
            Auth::login($user);
            $request->session()->regenerate();
            $test = Auth::check();
            $test = Auth::user()->id_utilisateur ; 
            return redirect()->route('homepage.index',compact('test'));
        }
        else
        {
            return back()->withErrors(['identifiant'=>'Email ou mot de passe incorrect',]);
        }
    }

    public function deconnexion(Request $request)
    {
        // Deconnecter l'utilisateur
        Auth::logout();
        // Invalité la session invalide
        $request->session()->invalidate();
        // Générer un nouveau token pour eviter les attaques
        $request->session()->regenerateToken();
        // Rediriger vers la page Accueil
        return redirect()->route('homepage.index')->with('succes','Vous êtes bien déconnecté.');
    }
}
