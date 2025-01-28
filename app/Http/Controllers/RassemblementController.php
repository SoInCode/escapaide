<?php

namespace App\Http\Controllers;

use App\Models\Rassemblement;
use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement;

class RassemblementController extends Controller
{
    public function index()
    {
        $departements = DB::table('departements')->get();
        $rassemblements = Rassemblement::all();
        return view('FrontOffice.Rassemblement.frontOffice_Rassemblement_index', compact('rassemblements', 'departements'));
    }

    public function create()
    {
        $departements = DB::table('departements')->get();
        $participants = Participant::all(); // Récupère tous les participants
        $utilisateurs = Auth::id();
        return view('FrontOffice.Rassemblement.frontOffice_Rassemblement_create', compact('participants', 'departements', 'utilisateurs'));
    }

    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
          
            'nom' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'localisation' => 'required|string|max:150',
            'ville' => 'required|string|max:100',
            'date_rassemblement' => 'required|date',
            'id_user' => 'required|exists:utilisateurs,id_user',
        ]);
        // Préparation des données pour insertion
    $data = $request->only(['nom', 'description', 'localisation', 'ville', 'date_rassemblement']);
    // // Ajout de l'utilisateur connecté
    $data['id_user'] = Auth::id();

    // Création du rassemblement dans la base
    Rassemblement::create($data);

        return redirect()->route('rassemblements.store')->with('success', 'Rassemblement créé avec succès.');
    }

    public function edit($id)
    {
        $departements = DB::table('departements')->get();
        $rassemblement = Rassemblement::findOrFail($id);
        $participants = Participant::all(); // Récupère tous les participants
    return view('FrontOffice.Rassemblement.frontOffice_Rassemblement_edit', compact('rassemblement', 'participants', 'departements'));
    }

    public function update(Request $request, $id)
    {
      
        $rassemblement = Rassemblement::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'localisation' => 'required|string|max:150',
            'ville' => 'required|string|max:100',
            'date_rassemblement' => 'required|date',
            // 'id_participant' => 'required|string|exists:participants,id_participant|unique:rassemblements,id_participant,' . $id,
            // 'id_user' => 'required|exists:users,id',
        ]);

        $rassemblement->update($request->all());

        return redirect()->route('rassemblements.index')->with('success', 'Rassemblement mis à jour avec succès.');
    }

    public function show($id)
{
    $departements = DB::table('departements')->get();
    $rassemblement = Rassemblement::with('participants.utilisateur', 'user')->findOrFail($id);
    return view('FrontOffice.Rassemblement.frontOffice_Rassemblement_show', compact('rassemblement', 'departements'));
}

public function rejoindre($id)
{
    // Vérifier si l'utilisateur est authentifié
    if (!Auth::check()) {
        return redirect()->route('user_page_Connexion')->with('error', 'Vous devez être connecté pour rejoindre ce rassemblement.');
    }

    // Récupérer le rassemblement
    $rassemblement = Rassemblement::findOrFail($id);

    // Vérifier si l'utilisateur est déjà participant
    $existingParticipant = DB::table('participants')
        ->where('id_user', Auth::id())
        ->where('id_rassemblement', $id)
        ->first();

    if ($existingParticipant) {
        return redirect()->back()->with('info', 'Vous participez déjà à ce rassemblement.');
    }

    // Ajouter l'utilisateur comme participant
    DB::table('participants')->insert([
        'id_user' => Auth::id(),
        'id_rassemblement' => $id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Vous avez rejoint ce rassemblement avec succès !');
}

public function leave($id)
{
    // Vérifier si l'utilisateur est authentifié
    if (!Auth::check()) {
        return redirect()->route('user_page_Connexion')->with('error', 'Vous devez être connecté pour quitter ce rassemblement.');
    }

    // Récupérer le rassemblement
    $rassemblement = Rassemblement::findOrFail($id);

    // Vérifier si l'utilisateur est déjà inscrit en tant que participant
    $existingParticipant = DB::table('participants')
        ->where('id_user', Auth::id()) // Cherche le participant par l'ID utilisateur
        ->where('id_rassemblement', $id) // Et le rassemblement auquel il participe
        ->first();

    // Si le participant n'existe pas dans la table, il n'est pas inscrit à ce rassemblement
    if (!$existingParticipant) {
        return redirect()->back()->with('error', 'Vous ne participez pas à ce rassemblement.');
    }

    // Supprimer le participant du rassemblement
    DB::table('participants')
        ->where('id_user', Auth::id()) // On supprime le participant par son ID utilisateur
        ->where('id_rassemblement', $id) // Et le rassemblement auquel il participe
        ->delete();

    // Retourner un message de succès
    return redirect()->back()->with('success', 'Vous avez quitté ce rassemblement avec succès.');
}


    public function destroy($id)
    {
        $rassemblement = Rassemblement::findOrFail($id);
        $rassemblement->delete();

        return redirect()->route('rassemblements.index')->with('success', 'Rassemblement supprimé avec succès.');
    }

    public function rechercher(Request $request)
    {
        // Récupérer le nom du département depuis le formulaire
        $nomDepartement = $request->input('nom_departement');
        
        // Récupérer tous les départements pour l'affichage
        $departements = Departement::all();
        
        // Filtrer les rassemblements par localisation (département)
        $rassemblements = Rassemblement::where('localisation', $nomDepartement)
        ->with(['participants', 'user']) // Charger les relations si nécessaires
        ->get();
        
            // Vérifier si des résultats ont été trouvés
            // if ($rassemblements->isEmpty()) {
            //     return redirect()->back()->with('info', 'Aucun rassemblement trouvé pour ce département.');
            // }
    
        // Afficher les résultats dans une vue
        return view('FrontOffice.Rassemblement.frontOffice_Rassemblement_show_results', compact('rassemblements', 'departements'));
    }
    
     
}    