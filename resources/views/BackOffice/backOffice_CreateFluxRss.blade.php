@extends('BackOffice.backOffice_Template')

@section('content')

    <form class="needs-validation" action="{{ route('admin_FluxRss_Store') }}" method="post">
        @csrf
        @method('post')
        <div class="form-row">

            <div class="form-group col-md-6">
                <label class="text-black" for="nom_flux">Nom de l'URL</label>
                <input type="text" value="{{old('nom_flux')}}" class="form-control @error('nom_flux') is-invalid @enderror"
                    id="nom_flux" placeholder="" name="nom_flux">
                @error('nom_flux')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="text-black" for="adresse_flux">Adresse de l'URL</label>
                <input type="text" value="{{old('adresse_flux')}}" class="form-control @error('adresse_flux') is-invalid @enderror"
                    id="adresse_flux" placeholder="" name="adresse_flux">
                @error('url_flux')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>
       

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

@endsection