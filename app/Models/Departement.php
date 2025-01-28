<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\BackOfficeFluxRss;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = "departements";
    protected $fillable = [
        'num_departement',
        'nom_departement',
    ];
}
