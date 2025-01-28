<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'participants'; 
    protected $primaryKey = 'id_rassemblement';
    protected $fillable = ['id_rassemblement', 'id_user'];  

    // Relations
    public function rassemblements()
    {
        return $this->hasMany(Rassemblement::class, 'id_rassemblement');
    }
    public function utilisateur()
{
    return $this->belongsTo(Utilisateur::class, 'id_user', 'id_user');
}
}
