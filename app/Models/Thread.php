<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Post;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{

    use SoftDeletes;
    
    protected $fillable = ['title', 'body', 'category_id', 'id_user'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
