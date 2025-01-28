<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MeteoController extends Controller
{
    public function getMeteo(): View
    {
        $city = request('city', 'Bordeaux'); // Ville par défaut : Bordeaux

        try {
            // Récupération de la liste des départements
            $departements = Departement::all();

            // Validation de la ville
            if (empty($city) || !preg_match('/^[a-zA-Z\s\-]+$/', $city)) {
                return view('FrontOffice.frontOffice_Homepage', compact('departements'))
                    ->with('error', 'Veuillez entrer un nom de ville valide.');
            }

            // Appel API pour récupérer les données météo
            $response = Http::get("https://www.prevision-meteo.ch/services/json/{$city}");
            
            if ($response->successful()) {
                $meteoData = $response->json();

                // Extraction des données de prévisions
                $forecastData = [];
                for ($i = 0; $i <= 4; $i++) {
                    $key = "fcst_day_{$i}";
                    if (isset($meteoData[$key])) {
                        $forecastData[] = $meteoData[$key];
                    }
                }

                // Si les données sont disponibles, les retourner à la vue
                return view('FrontOffice.frontOffice_Homepage', compact('forecastData', 'departements', 'city'));
            }

            // Gestion des cas où l'API retourne une erreur
            return view('FrontOffice.frontOffice_Homepage', compact('departements'))
                ->with('error', "Données météo non disponibles pour la ville : {$city}");
        } catch (\Exception $e) {
            // Gestion des erreurs lors de la requête
            return view('FrontOffice.frontOffice_Homepage', compact('departements'))
                ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // Méthode pour rendre le widget accessible sur toutes les pages
    public function getMeteoAjax()
{
    $city = request('city', 'Bordeaux');

    try {
        $response = Http::get("https://www.prevision-meteo.ch/services/json/{$city}");
        
        if ($response->successful()) {
            $meteoData = $response->json();
            $forecastData = [];

            for ($i = 0; $i <= 4; $i++) {
                $key = "fcst_day_{$i}";
                if (isset($meteoData[$key])) {
                    $forecastData[] = $meteoData[$key];
                }
            }

            return response()->json([
                'success' => true,
                'city' => $city,
                'forecastData' => $forecastData
            ]);
        }

        return response()->json(['success' => false, 'message' => "Données météo non disponibles pour la ville : {$city}"]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
}

}


