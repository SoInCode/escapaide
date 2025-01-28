<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\FluxRSS;
use App\Models\site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
//use SimpleXMLElement;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class AgendaCulturelController extends Controller
{
    public function index()
    {
        $fluxRss = Departement::all(); // Chargez tous les départements
        return view('FrontOffice.AgendaCulturel.index', compact('departements', 'fluxRSS'));
    }
    //  afficher le flux RSS basé sur un numéro de département.
    public function RSS(Request $request)
    {
        $departements = Departement::all(); 
    
        // Récupérer le numéro de département depuis la requête
        $num_departement = $request->query('num_departement');

          // Récupérer le nom du département en utilisant le bon nom de colonne
        $departement = Departement::where('num_departement', $num_departement)->first();
        $departementNom = $departement ? $departement->nom_departement : 'Département inconnu';

        // Construire l'URL du flux RSS
        $rssUrl = "https://{$num_departement}.agendaculturel.fr/rss";
        $fluxRss = simplexml_load_file($rssUrl, 'SimpleXMLElement', LIBXML_NOCDATA);
    
        // Convertir les éléments du flux RSS en un tableau pour le rendre compatible avec la Collection
        $rssItemsArray = [];
        if ($fluxRss && isset($fluxRss->channel->item)) {
            foreach ($fluxRss->channel->item as $item) {
                $rssItemsArray[] = [
                    'title'       => (string) $item->title,
                    'description' => (string) $item->description,
                    'link'        => (string) $item->link,
                    'pubDate'     => (string) $item->pubDate,
                ];
            }
        }
    
        // Convertir en Collection Laravel
        $rssItemsCollection = collect($rssItemsArray);
    
        // Pagination
        $perPage = 16;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $rssItemsCollection->slice(($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            $rssItemsCollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        // Passer les éléments paginés à la vue
        return view('FrontOffice.AgendaCulturel.index', compact('paginatedItems', 'departements', 'num_departement'));
    }
 }
