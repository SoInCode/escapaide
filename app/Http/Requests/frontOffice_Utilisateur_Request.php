<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Utilisateur;

class frontOffice_Utilisateur_Request extends FormRequest
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

public function rules(): array
{
    return [

        "identifiant" => 'required|unique:utilisateurs',
        "nom" => 'required',
        "prenom" => 'required',
        "mot_de_passe" => 'required',
        "email" => 'required|unique:utilisateurs',
        "numero_de_telephone" => 'required|unique:utilisateurs',
        "age" => 'required',
        "localisation" => 'required',
        "centres_d_interet" => 'required',
        "type_aides" => 'required',
        "accessibilite_specifique" => 'required',
    ];
}
 }
