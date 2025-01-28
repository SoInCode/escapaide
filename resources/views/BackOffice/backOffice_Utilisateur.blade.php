@extends('BackOffice.backOffice_Template')

@section('content')

    <div class="row row-cols-3">
        @foreach($utilisateurs as $utilisateur)

            <div class="col-md-2">
                <div class="card bg-secondary">
                    <div class="card-header">Photos de Profil</div>
                    <div class="card-body"><p class="card-text">{{$utilisateur ['identifiant']}}</p></div>
                    <div class="card-footer">
                        <form action="{{ route('admin_Utilisateur_Destroy', $utilisateur['id_user']) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('êtes-vous sur ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection