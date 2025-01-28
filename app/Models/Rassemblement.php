<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Utilisateur;
use App\Models\Participant;

class Rassemblement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rassemblements';

    protected $primaryKey = 'id_rassemblement'; 

    protected $fillable = [
        'nom',
        'description',
        'localisation',
        'ville',
        'date_rassemblement',
        'id_user',
    ];

    // Relations

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_user');
    }

    public function participants()
    {
    return $this->hasMany(Participant::class, 'id_rassemblement', 'id_rassemblement');
    }

    public function user()
    {
    return $this->belongsTo(Utilisateur::class, 'id_user', 'id_user');
    }
    public function departement()
    {
        return $this->hasOne(Departement::class, 'nom_departement', 'localisation');
    }
}
