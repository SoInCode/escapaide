@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css', 'resources/js/app.js', 'resources/js/accessibility.js'])
@section('content')

<div class="container">
    <h1>Agenda culturel de votre département</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif</h1>


    <div class="d-flex flex-wrap justify-content-center">
        @if($paginatedItems->isNotEmpty())
            @foreach($paginatedItems as $item)
                <div class="card text-center m-3" style="width: 18rem; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{!! $item['title'] !!}</h5>
                        <p class="card-text flex-grow-1">{!! $item['description'] !!}</p>
                        <a href="{!! $item['link'] !!}" class="btn btn-primary mt-auto">Plus d'infos</a>
                    </div>
                </div>
            @endforeach
        @else
            <p>Aucun flux RSS n'est disponible pour ce département.</p>
        @endif
    </div>

    <!-- Liens de pagination -->
    @if ($paginatedItems->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Lien vers la page précédente --}}
            @if ($paginatedItems->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginatedItems->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Numéros des pages --}}
            @foreach ($paginatedItems->links()->elements as $element)
                {{-- Cas des points de suspension --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Liens des pages --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginatedItems->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Lien vers la page suivante --}}
            @if ($paginatedItems->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginatedItems->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
</div>
@endsection
