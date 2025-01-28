<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\SiteController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AgendaCulturel extends Model
{
/** @use HasFactory<\Database\Factories\SiteFactory> */
    use HasFactory;
    use SoftDeletes;
    
    public $table = 'departements';
    protected $fillable = ['num_departement','nom_departement'];

//     public function getDescriptionSansHtmlAttribute()
// {
//     return strip_tags($this->attributes['description']); // Remplacez 'description' par le champ contenant votre texte
// }
    
    // protected $table = 'flux_rss';
    // protected $fillable = ['nom_flux', 'adresse_flux'];
}
