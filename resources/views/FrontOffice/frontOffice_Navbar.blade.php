@vite(['resources/css/styleFrontOfficeNavbar.css','resources/js/accessibility.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Escap'Aide Logo" style="height: 50px;">
        </a>
          <!-- Bouton Toggle pour menu burger -->
          <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarContent" 
            aria-controls="navbarContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenu de la navbar -->
        <div class="collapse navbar-collapse" id="navbarContent">
        <!-- Bouton pour ouvrir le modal pour les accessibilité -->
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#accessibilityModal">
            Accessibilité
        </button>
        <!-- Modal des accessibilités -->
        <div class="modal fade  dark-mode" id="accessibilityModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accessibilityModalLabel">Options d'Accessibilité</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-primary" id="increaseText">Grossir le texte</button>
                        <button class="btn btn-primary" id="decreaseText">Rétrécir le texte</button>
                        <button class="btn btn-primary" id="resetText">Réinitialiser la taille du texte</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bouton Dark Mode -->
        <div class="form-check form-switch ms-auto">
            <input class="form-check-input" type="checkbox" id="darkModeToggle" aria-label="Basculer le mode sombre">
            <label class="form-check-label" for="darkModeToggle">Mode Sombre</label>
         </div>


            
            <!-- Dropdown "Flux RSS" et champ de recherche -->
            <div class="mx-auto">
            <form action="{{ route('flux_rss') }}" method="GET" class="d-flex">
                <select name="num_departement" class="form-select me-2">
                    <option>Agenda culturel par département</option>
                    @foreach($departements as $departement)
                    <option value="{{ $departement->num_departement }}" 
                    @if(isset($num_departement) && $departement->num_departement == $num_departement) selected @endif>
                    {{ $departement->nom_departement }}
                </option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>
            </div>

            <!-- Bouton pour afficher les forums -->
            <div class="d-flex mx-auto">
            <a href="{{ route('threads.index') }}" class="btn btn-primary ms-3">Forum</a>
            <a href="{{ route('rassemblements.index') }}" class="btn btn-primary ms-3">Rassemblements</a>
            </div>

        <div class="d-flex ms-auto">
            @if(auth()->user())
                <!-- Bouton pour acceder a la page mon profil -->
                <a href="{{ route('user_profil', ['identifiant' => Auth::user()->identifiant]) }}"
                    class="btn btn-outline-secondary me-2">Mon Profil</a>
                <!-- Afficher le bouton "Se déconnecter" si l'utilisateur est connecté -->
                <a href="{{ route('user_deconnexion') }}" class="btn btn-outline-secondary"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Se déconnecter
                </a>
                <!-- Formulaire pour la déconnexion -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <!-- Afficher les boutons "S'inscrire" et "S'identifier" si l'utilisateur n'est pas connecté -->
                <a href="{{ route('user_inscription') }}" class="btn btn-outline-secondary me-2">S'inscrire</a>
                <a href="{{ route('user_page_Connexion') }}" class="btn btn-outline-secondary">S'identifier</a>
            @endif
        </div>
    </div>
    </div>
</nav>  