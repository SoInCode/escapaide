<?php

namespace App\Http\Controllers;

use App\Models\site;
use App\Http\Requests\StoresiteRequest;
use App\Http\Requests\UpdatesiteRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Departement;

class SiteController extends Controller
{

    // Fonction permetant l'affichage des départements sur la navbar
    public function index()
    {
       
        $departements = Departement::all();
        return view('FrontOffice.frontOffice_Homepage',compact('departements'));
        //return view('homepage.index',compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresiteRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesiteRequest $request, site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(site $site)
    {
        //
    }
}
