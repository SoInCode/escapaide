@extends('FrontOffice.frontOffice_Template')

@section('content')
<div class="container">
    <h1>Créer un nouveau sujet</h1>
    <form action="{{ route('threads.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">Description</label>
            <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Publier</button>
    </form>
</div>
@endsection
