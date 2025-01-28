@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css'])
@section('content')

<div class="container">
    <h1>Modifier le Rassemblement</h1>
    <form action="{{ route('rassemblements.update', $rassemblement->id_rassemblement) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ $rassemblement->nom }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" required>{{ $rassemblement->description }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="localisation">Localisation</label>
            <input type="text" id="localisation" name="localisation" class="form-control" value="{{ $rassemblement->localisation }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" class="form-control" value="{{ $rassemblement->ville }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="date_rassemblement">Date</label>
            <input type="datetime-local" id="date_rassemblement" name="date_rassemblement" class="form-control" value="{{ $rassemblement->date_rassemblement }}" required>
        </div>

        <!-- <div class="form-group mt-3">
            <label for="id_participant">Participant</label>
            <select id="id_participant" name="id_participant" class="form-control" required>
                @foreach($participants as $participant)
                    <option value="{{ $participant->id_participant }}" {{ $participant->id_participant == $rassemblement->id_participant ? 'selected' : '' }}>
                        {{ $participant->nom }} {{ $participant->prenom }}
                    </option>
                @endforeach
            </select>
        </div> -->

        <!-- <div class="form-group mt-3">
            <label for="id_user">Utilisateur</label>
            <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">
            <input type="text" class="form-control" value="{{ Auth::id() }}" disabled>
        </div>  -->

        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>
@endsection