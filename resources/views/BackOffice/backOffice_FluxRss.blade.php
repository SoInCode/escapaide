@extends('BackOffice.backOffice_Template')

@section('content')
    <div class="ajouter">
            <a class="btn btn-primary" href="{{ route ('admin_FluxRss_Create') }}">Ajouter un nouveau FluxRss</a>
            <a class="btn btn-primary" href="{{ route('admin_Homepage') }}">Retour au Homepage</a>
    </div>
        <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">ID</td>
            <th scope="col">Nom du FluxRss</th>
            <th scope="col">Adresse du FluxRss</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
@foreach ($flux as $fluxRss)
        <tr>
            <th scope="row">{{$fluxRss->id}}</th>
            <td>{{$fluxRss->nom_flux}}</td>
            <td>{{$fluxRss->adresse_flux}}</td>
            <td><a href="{{ route ('admin_FluxRSs_edit' , $fluxRss->id) }} " class="btn btn-primary">Modifier</a></td>
            <td>
                <form action="{{ route ('admin_FluxRss_Destroy',$fluxRss->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('êtes-vous sur ?')">Supprimer</button>
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
    </table>
@endsection