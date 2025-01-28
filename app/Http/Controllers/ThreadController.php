<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Utilisateur;



class ThreadController extends Controller
{
    public function index()
    {
        $departements = DB::table('departements')->get();
        $profil = 0 ;
        $threads = Thread::with('user', 'category')->get();
        $threads = Thread::paginate(2);
        foreach($threads as $thread){

            $thread->identifiant = Utilisateur::where('id_user', $thread->id_user)->select('identifiant')->first();
        };

        return view('FrontOffice.Forum.index', compact('threads', 'departements','profil'));
    }

    public function create()
    {
        $departements = DB::table('departements')->get();
        $categories = Category::all();
        return view('FrontOffice.Forum.create', compact('categories', 'departements'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Thread::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'id_user' => Auth::user()->id_user,
        ]);

        return redirect()->route('threads.index')->with('success', 'Sujet créé avec succès !');
    }
    
    // Affiche un thread spécifique
    public function show($id)
    {
        $departements = DB::table('departements')->get();
        $thread = Thread::with( 'category', 'posts', 'user')->findOrFail($id);
        $thread->id_user = Utilisateur::where('id_user', $thread->id_user)->select('identifiant')->first();
        $utilisateur = Auth::user();
        $post = $thread->posts->where('id_user', Auth::id())->first()->id ?? null;
        // $post = $thread->posts->where('id_user', Utilisateur::id_user())->first()->id ?? null;

        return view('FrontOffice.Forum.show', compact('thread', 'departements', 'utilisateur', 'post'));
      
    }

    // Affiche le formulaire de modification d'un thread
    public function edit($id, $profil)
    {
        //dd($profil);
        $thread = Thread::findOrFail($id);

        // Vérification que l'utilisateur est bien le créateur du thread
        if (Auth::user()->id_user !== $thread->id_user) {
            return redirect()->route('threads.index')->withErrors('Vous n\'êtes pas autorisé à modifier ce sujet.');
        }
        $departements = DB::table('departements')->get();
        $categories = Category::all();
        return view('FrontOffice.Forum.edit', compact('thread', 'categories', 'departements','profil'));
    }

    // Met à jour un thread existant
    public function update(Request $request, $id, $profil)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread = Thread::findOrFail($id);

        // Vérification que l'utilisateur est bien le créateur du thread
        if (Auth::user()->id_user !== $thread->id_user) {
            return redirect()->route('threads.index')->withErrors('Vous n\'êtes pas autorisé à modifier ce sujet.');
        }

        $thread->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);
        if($profil == 1){
            return redirect()->route('user_profil', ['identifiant' => Auth::user()->identifiant])->with('success', 'Sujet mis à jour avec succès !');
        }
        else{
            return redirect()->route('threads.index')->with('success', 'Sujet mis à jour avec succès !');
        }
    }

    // Supprime un thread existant
    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);

        // Vérification que l'utilisateur est bien le créateur du thread
        if (Auth::user()->id_user !== $thread->id_user) {
            return redirect()->route('threads.index')->withErrors('Vous n\'êtes pas autorisé à supprimer ce sujet.');
        }

        $thread->delete();

        return redirect()->route('threads.index')->with('success', 'Sujet supprimé avec succès !');
    }
    public function storePost(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);
    // dd($id_user);
    
    $thread = Thread::findOrFail($id);

    $thread->posts()->create([
        'id_user' => Auth::id(),
        'body' => $request->body,
        'thread_id' => $id, 
    ]);

    return redirect()->route('posts.show', $id)->with('success', 'Réponse ajoutée avec succès.');
}
}

    

