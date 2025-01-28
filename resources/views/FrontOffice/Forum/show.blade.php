@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css'])
@section('content')

<!-- pour afficher le laius du thread -->
<div class="container">
    <h1><strong>{{ $thread->title }}</strong></h1>
    <p>{{ $thread->body }}</p>
    <p>Posté par : {{ $thread->id_user->identifiant ?? 'Utilisateur inconnu' }} 
         dans <strong>{{ $thread->category->name }}</strong></p>

    <hr>
    <!-- pour afficher les réponses -->
    <h2>Réponses</h2>
        @foreach($thread->posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <p>Posté par : {{ $post->user->identifiant ?? 'Utilisateur inconnu' }}</p>
                <p>{{ $post->body }}</p>
            </div>
    </div>
    @endforeach

    @auth
    <!-- pour ajouter les réponses et les stocker -->
    <form action="{{ route('posts.store', $thread->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="body">Ajouter une réponse</label>
            <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Répondre</button>
    </form>
    @else
    <p><a href="{{ route('user_page_Connexion') }}">Connectez-vous pour ajouter une réponse.</a></p>
    @endauth
</div>
@endsection