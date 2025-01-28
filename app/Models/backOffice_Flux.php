<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\BackOfficeFluxRss;
use Illuminate\Database\Eloquent\SoftDeletes;

class backOffice_Flux extends Model
{
    use SoftDeletes;
    public $table = 'flux_rss';
    protected $fillable = ['nom_flux','adresse_flux'];
    use HasFactory;
}