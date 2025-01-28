@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css', 'resources/css/styleFrontOfficeTemplate.css'])
@section('content')

<div class="container">
    <h1>Liste des rassemblements</h1>

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

    @if(auth()->user())
    <a href="{{ route('rassemblements.create') }}" class="btn btn-primary mb-3">Créer un nouveau rassemblement</a>
    @endif
    
    <div class="row">
        @if($rassemblements->isEmpty())
            <div class="alert alert-warning">
                Aucun rassemblement trouvé pour ce département.
            </div>
        @else
            @foreach($rassemblements as $rassemblement)
                <!-- Conteneur pour les cartes -->
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rassemblement->nom }}</h5>
                            <p class="card-text">{{ Str::limit($rassemblement->description, 100) }}</p> <!-- Description courte -->
                            <p class="card-text"><strong>Localisation:</strong> {{ $rassemblement->localisation }}</p>
                            <p class="card-text"><strong>Ville:</strong> {{ $rassemblement->ville }}</p>
                            <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($rassemblement->date_rassemblement)->format('d M Y') }}</p>
                        
                            <a href="{{ route('rassemblements.show', $rassemblement->id_rassemblement) }}" class="btn btn-info btn-sm">Voir</a>

                            <!-- Boutons de modification et suppression uniquement pour le créateur -->
                            @if(Auth::id() === $rassemblement->id_user)
                                <div class="mt-2">
                                    <a href="{{ route('rassemblements.edit', $rassemblement->id_rassemblement) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('rassemblements.destroy', $rassemblement->id_rassemblement) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rassemblement ?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection