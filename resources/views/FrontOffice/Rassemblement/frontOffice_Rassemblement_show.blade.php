@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css'])

@section('content')
<div class="container">
    <h1>Rassemblement : {{ $rassemblement->nom }}</h1>
    <p><strong>Description :</strong> {{ $rassemblement->description }}</p>
    <p><strong>Localisation :</strong> {{ $rassemblement->localisation }}</p>
    <p><strong>Ville :</strong> {{ $rassemblement->ville }}</p>
    <p><strong>Date :</strong> {{ $rassemblement->date_rassemblement }}</p>
    <p><strong>Créé par :</strong> {{ $rassemblement->user->identifiant ?? 'Utilisateur inconnu' }}</p>

    <hr>

    <h2>Participants</h2>
    @auth
    <form action="{{ route('rassemblements.rejoindre', $rassemblement->id_rassemblement) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-primary">Rejoindre ce rassemblement</button>
    </form>
@else
    <p><a href="{{ route('user_page_Connexion') }}">Connectez-vous pour rejoindre ce rassemblement.</a></p>
@endauth
    @if($rassemblement->participants && $rassemblement->participants->isNotEmpty())
        <ul>
            @foreach($rassemblement->participants as $participant)
                <li>{{ $participant->utilisateur->identifiant }} </li>
            @endforeach
        </ul>
        @else
        <p>Aucun participant pour ce rassemblement.</p>
    @endif

    @auth
        @if($rassemblement->participants->contains('id_participant', Auth::user()->id))
            <form action="{{ route('rassemblements.leave', $rassemblement->id_rassemblement) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir quitter ce rassemblement ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Je ne participe plus</button>
            </form>
        @endif
    @endauth

    <a href="{{ route('rassemblements.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection