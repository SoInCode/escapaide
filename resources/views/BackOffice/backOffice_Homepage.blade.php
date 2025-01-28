@extends('BackOffice.backOffice_template')


    @section('content')
        <div>
            <a class="btn btn-primary" href="{{ route('Gestion_FluxRss') }}">Gestion des Flux Rss</a>
            <a class="btn btn-primary" href="{{ route('admin_Utilisateur_Index') }}">Gestion des Utilisateurs</a>
        </div>
    @endsection