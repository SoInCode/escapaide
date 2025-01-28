@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css'])
@section('content')

<div class="container">
    <h1>Liste des rassemblements</h1>
    <!-- Pour afficher les rassemblements par départements -->
    <form action="{{ route('rassemblements.rechercher') }}" method="POST">
    @csrf
    <select name="nom_departement">
        <option value="">Sélectionnez un département pour voir les rassemblements</option>
        @foreach($departements as $departement)
            <option value="{{ $departement->nom_departement }}">{{ $departement->nom_departement }}</option>
        @endforeach
    </select>
    <button type="submit">Rechercher</button>
</form>

    <!-- Vérification si des rassemblements sont trouvés -->
    @if($rassemblements->isEmpty())
        <p>Aucun rassemblement trouvé pour ce département.</p>
    @else
        @foreach($rassemblements as $rassemblement)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $rassemblement->nom }}</h5>
                    <p class="card-text">Département : {{ $rassemblement->departements->nom_departement ?? 'Non défini' }}</p>
                    <p class="card-text">{{ $rassemblement->description }}</p>
                    <p class="card-text">Localisation: {{ $rassemblement->localisation }}</p>
                    <p class="card-text">Ville: {{ $rassemblement->ville }}</p>
                    <p class="card-text">Date: {{ $rassemblement->date_rassemblement }}</p>
                    <p class="card-text">Créé par : {{ $rassemblement->user->identifiant ?? 'Utilisateur inconnu' }}</p>
                <div>
                @if($rassemblement->id_rassemblement)
                <a href="{{ route('rassemblements.show', $rassemblement->id_rassemblement) }}" class="btn btn-info btn-sm">Voir</a>
            @else
                <span class="text-muted">Lien non disponible</span>
            @endif
                </div>

                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
