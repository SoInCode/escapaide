<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;

class Message extends Model
{
    public function user() {
        return $this->belongsTo(Utilisateur::class);
    }
}
