<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Utilisateur extends Model implements AuthenticatableContract
{
    use SoftDeletes;
    use HasFactory;
    use Authenticatable;

    protected $table = 'utilisateurs';

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';  

    protected $fillable = [
        'identifiant',
        'nom',
        'prenom',
        'mot_de_passe',
        'email',
        'numero_de_telephone',
        'age',
        'localisation',
        'centres_d_interet',
        'type_aides',
        'accessibilite_specifique',
        'id_roles',
        'remember_token',
    ];
    
    protected $casts = [
        'age' => 'integer',
        'id_roles' => 'integer',
    ];
    
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function isAdmin()
    {
        return $this->id_roles === 1;
    }
    
    public function participants()
    {
        return $this->hasMany(Participant::class, 'id_user', 'id_user');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
}
