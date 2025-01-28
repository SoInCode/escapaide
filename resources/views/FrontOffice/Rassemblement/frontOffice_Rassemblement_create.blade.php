@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css'])
@section('content')

<form action="{{ route('rassemblements.store') }}" method="POST">
@csrf
<div class="form-group mt-3">
    <h1>Créer un nouveau Rassemblement</h1>
    <label for="nom">Nom</label></a>
    <input type="text" id="nom" name="nom" class="form-control" required>
</div>

<div class="form-group mt-3">
    <label for="description">Description</label>
    <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
</div>

<div class="form-group mt-3">
<select name="localisation">
        <option value="">Sélectionnez un département pour voir les rassemblements</option>
        @foreach($departements as $departement)
            <option value="{{ $departement->nom_departement }}">{{ $departement->nom_departement }}</option>
        @endforeach
    </select>
    <!-- <label for="localisation">Localisation</label>
    <input type="text" id="localisation" name="localisation" class="form-control" required> -->
</div>

<div class="form-group mt-3">
    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" class="form-control" required>
</div>

<div class="form-group mt-3">
    <label for="date_rassemblement">Date</label>
    <input type="datetime-local" id="date_rassemblement" name="date_rassemblement" class="form-control" required>
</div>
 
 <!-- <div class="form-group mt-3">
        <label for="id_participant">Participant</label>
        <select id="id_participant" name="id_participant" class="form-control" required>
            @foreach($participants as $participant)
                <option value="{{ $participant->id_participant }}">{{ $participant->nom }} </option>
            @endforeach
        </select>
    </div>  -->
    <div>
    <input type="hidden" name="id_user" value="{{ Auth::id() }}">
        <button type="submit" class="btn btn-primary mt-3">Créer</button>
</div>
</form>
</div>
@endsection

