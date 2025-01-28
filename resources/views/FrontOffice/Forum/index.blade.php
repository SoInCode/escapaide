@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeTemplate.css'])
@section('content')

<div class="container">
    <h1>Forum</h1>

    <!-- Bouton Créer un sujet (visible uniquement pour les utilisateurs connectés) -->
    @auth
        <a href="{{ route('threads.create') }}" class="btn btn-primary mb-3">Créer un sujet</a>
    @endauth

    @foreach($threads as $thread)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <strong>Posté 
                        par : {{ $thread->identifiant->identifiant ?? 'Utilisateur inconnu' }} 
                        dans {!! $thread->category->name !!}</strong>
                    </h5>
                        <p> {!! $thread->title !!}</p>
                        <p class="card-text">{{ $thread->body }}</p>
                    <!--Rajout d'un bouton pour forcer la méthode GET -->
                    <form action="{{ route('posts.show', $thread->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-danger btn-sm">Voir le sujet</button>
                    </form>
                    <a href="{{ route('threads.show', $thread->id) }}"></a>
                <!-- Boutons Modifier et Supprimer (visible uniquement pour l'auteur du sujet) -->
                @auth
                    @if (Auth::user()->id_user == $thread->id_user)
                        <div class="mt-3">
                            <a href="{{ route('threads.edit', ['id' => $thread->id , 'profil' => $profil]) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('threads.destroy', $thread->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sujet ?')">Supprimer</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach

    {{ $threads->links('pagination::bootstrap-5') }}
</div>
@endsection
