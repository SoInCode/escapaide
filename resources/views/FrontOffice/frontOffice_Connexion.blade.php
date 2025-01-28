@extends('FrontOffice.frontOffice_Template')

@section('content')



    <form action="{{ route('user_connexion') }}" method="POST">

            @csrf
            
            <div class="form-group">
                <label for="identifiant" class="form-label">Identifiant :</label>
                <input type="text" class="form-control" id="identifiant" name="identifiant" value="{{ old('identifiant') }}" required>
                @error('identifiant')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                @error('mot_de_passe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Connexion</button>
    </form>

@endsection