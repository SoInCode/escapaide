<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\backOffice_Flux;
use App\Http\Requests\backOffice_FluxRss_Request;

class BackOfficeFluxRss extends Controller
{

    // Afficher la liste des fluxRss 
    public function index()
    {
        $flux = backOffice_Flux::all();
        return view('BackOffice.backOffice_FluxRss',compact('flux'));
    }

    // Acceder a la page de création d'un FluxRss
    public function create()
    {
        return view('BackOffice.backOffice_CreateFluxRss');
    }

    // enregistrer le FluxRss crée avec un retour a la page de gestion avec un message 
    public function store(backOffice_FluxRss_Request $request)
    {
        $validatedData = $request->validated();
        backOffice_Flux::create($validatedData);
        return redirect()->route('Gestion_FluxRss')->with('success','Nouveau FluxRss crée');
    }

    // acceder a la page de modification d'un FluxRss
    public function edit(string $id)
    {
        $fluxRss = backOffice_Flux::find($id)->toArray();
        return view('BackOffice.backOffice_UpdateFluxRss', compact('fluxRss'));
    }

    // enregister les modification du FluxRss et retourner a la page de gestion avec un message
    public function update(backOffice_FluxRss_Request $request, string $id)
    {
        $validatedData = $request->validated();
        $fluxRss = backOffice_Flux::find($id);

        $info = "";

        try{
            $fluxRss->update($validatedData);
            $info = "Vos modification ont été pris en compte";
        }
        catch(Exception $e){
            $info = "Erreur dans vos modification";
        }
        return redirect()->route('Gestion_FluxRss')->with('success',$info);
    }

    // effectuer un soft-delete d'un flux rss sans option de le re-mettre
    public function destroy(string $id)
    {
        $fluxRss = backOffice_Flux::find($id);
        $fluxRss->delete();
        return redirect()->route('Gestion_FluxRss')->with('success','FluxRss supprimé');
    }

}


