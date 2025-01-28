@extends('FrontOffice.frontOffice_Template')

@section('content')
    <form action="{{ route('threads.update',['id' => $thread->id , 'profil' => $profil]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="{{ $thread->title }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="body">Contenu</label>
            <textarea id="body" name="body" class="form-control" required>{{ $thread->body }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $thread->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('threads.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
