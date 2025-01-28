<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SiteController;
use Illuminate\Database\Eloquent\SoftDeletes;

class site extends Model
{
    /** @use HasFactory<\Database\Factories\SiteFactory> */
    use SoftDeletes;
    use HasFactory;
    public $table = 'departements';
    protected $fillable = ['num_departement','nom_departement'];
}
