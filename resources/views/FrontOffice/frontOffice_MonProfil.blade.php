@extends('FrontOffice.frontOffice_Template')

@section('content')

    <div class="border-bottom border-secondary">
        <h1>Page De {{$utilisateur->identifiant}}</h1>
        <h2>Je m'appelle {{$utilisateur->prenom}} , j'ai {{$utilisateur->age}} ans , j'habite à {{$utilisateur->localisation}}</h2>

        <p>centre d'interet :  
        @if($utilisateur->centre_d_interet === NULL)
             Aucun</p>
        @else
            {{$utilisateur->centre_d_interet}}</p>
        @endif

        <p>Type d'aide nécessaire : 
        @if($utilisateur->type_aides === NULL)
            Aucun</p>
        @else
            {{$utilisateur->type_aides}}</p>
        @endif

        <p>Accessibilité spécifique : 
        @if ($utilisateur->accessibilite_specifique === NULL)
            Aucun</p>
        @else
         {{$utilisateur->accessibilite_specifique}}</p>
        @endif

        <div class="mt-3">
            <!--Bonton pour modifier le profil -->
            <a class="btn btn-warning btn-sm" href="{{route('user_modifier', ['identifiant' => Auth::user()->identifiant])}}">Modifier</a>
            <!--Bouton pour supprimer le profil -->
            <form action="{{ route('user_delete', ['identifiant' => Auth::user()->id_user]) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sujet ?')">Supprimer</button>
            </form>
        </div>
    </div>

    <h2>Mes Sujets</h2>
<!--   For Each qui affiche la liste des threads crée par l'utilisateur  -->
    @foreach($listeThreads as $Threads)
        <div class="border-bottom border-secondary">
            <p>{{$Threads->title}}</p>
            <p>{{$Threads->body}}</p>
            <div class="mt-3">
                    <a href="{{ route('threads.edit', ['id' => $Threads->id , 'profil' => $profil]) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('threads.destroy', $Threads->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sujet ?')">Supprimer</button>
                    </form>
            </div>
        </div>
    @endforeach

@endsection