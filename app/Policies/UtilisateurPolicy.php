<?php

namespace App\Policies;

use App\Models\Utilisateur;
use Illuminate\Auth\Access\Response;

class UtilisateurPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Utilisateur $utilisateur): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Utilisateur $utilisateur,): bool
    {
                // Autoriser uniquement si l'utilisateur authentifié est le même que l'utilisateur demandé
                return $user->id === $utilisateur->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Utilisateur $utilisateur): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Utilisateur $utilisateur): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Utilisateur $utilisateur): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Utilisateur $utilisateur): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Utilisateur $utilisateur): bool
    {
        //
    }
}
