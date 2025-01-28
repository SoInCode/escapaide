<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Utilisateur;

class frontOffice_Utilisateur_Update_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

public function rules($identifiant): array
{
    $user = Utilisateur::where('identifiant', $identifiant)->firstOrFail();

    return [
        "identifiant" => 'required|unique:utilisateurs' . $user->id, // PERMET D'IGNORER L'EMAIL DE L'UTILISATEUR ACTUELLE AFIN D'EVITER LES CONFLIE AVEC LUI MEME
        "nom" => 'required',
        "prenom" => 'required',
        //"mot_de_passe" => 'required',
        "email" => 'required|unique:utilisateurs,email'. $user->id, // PERMET D'IGNORER L'EMAIL DE L'UTILISATEUR ACTUELLE AFIN D'EVITER LES CONFLIE AVEC LUI MEME
        "numero_de_telephone" => 'required|unique:utilisateurs' . $user->id,
        "age" => 'required',
        "localisation" => 'required',
        "centres_d_interet" => 'required',
        "type_aides" => 'required',
        "accessibilite_specifique" => 'required',
    ];
}
 }
