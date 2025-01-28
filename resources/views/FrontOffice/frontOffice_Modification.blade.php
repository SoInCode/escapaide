@extends('FrontOffice.frontOffice_Template')

@section ('content')

<form class="nedd-validation" action="{{ route('user_update', ['identifiant' => $utilisateur->id_user]) }}" method="POST">
    @csrf 

    @method('PUT')

    <div class="container align-item-center">
    <!-- <div class="form-group col-4">
            <label for="identifiant" class="form-label">Identifiant :</label>
            <input type="text" class="form-control" id="identifiant" name="identifiant" value="{{ old('identifiant', $utilisateur->identifiant)  }}" required>
            @error('identifiant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <div class="form-group col-4">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $utilisateur['nom']) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $utilisateur['prenom']) }}" required>
            @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- <div class="form-group col-4">
            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            @error('mot_de_passe')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <div class="form-group col-4">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $utilisateur['email']) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="numero_de_telephone" class="form-label">Numéro de téléphone :</label>
            <input type="text" class="form-control" id="numero_de_telephone" name="numero_de_telephone" value="{{ old('numero_de_telephone', $utilisateur['numero_de_telephone']) }}" required>
            @error('numero_de_telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="age" class="form-label">Âge :</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $utilisateur['age']) }}" required>
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="localisation" class="form-label">Localisation :</label>
            <input type="text" class="form-control" id="localisation" name="localisation" value="{{ old('localisation', $utilisateur['localisation']) }}" required>
            @error('localisation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="centres_d_interet" class="form-label">Centres d'intérêt :</label>
            <input type="text" class="form-control" id="centres_d_interet" name="centres_d_interet" value="{{ old('centres_d_interet', $utilisateur['centres_d_interet']) }}">
            @error('centres_d_interet')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="type_aides" class="form-label">Type d'aides :</label>
            <input type="text" class="form-control" id="type_aides" name="type_aides" value="{{ old('type_aides', $utilisateur['type_aides']) }}">
            @error('type_aides')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-4">
            <label for="accessibilite_specifique" class="form-label">Accessibilité spécifique :</label>
            <input type="text" class="form-control" id="accessibilite_specifique" name="accessibilite_specifique" value="{{ old('accessibilite_specifique', $utilisateur['accessibilite_specifique']) }}">
            @error('accessibilite_specifique')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>

</form>

@endsection