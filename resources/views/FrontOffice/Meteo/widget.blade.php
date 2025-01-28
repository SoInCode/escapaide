@vite(['resources/css/styleFrontOfficeHomepage.css', 'resources/js/accessibility.js', 'resources/js/widget.js',  'resources/css/meteo.css'])


<div id="meteo-widget" class="d-flex text-center bg-secondary">
    <div class="card-text">
        <!-- Formulaire pour la recherche de ville -->
        <form id="meteo-form">
            <input 
            type="text" 
            id="city-input" 
            placeholder="Entrez une ville" 
            value="Bordeaux">
            <button type="submit">Rechercher</button>
        </form>
        
        <!-- Conteneur où les données météo seront affichées -->
        <div id="meteo-content" class="card text-white bg-secondary">
            
            <p>Chargement des données météo...</p>
        </div>   
    </div>
</div>

