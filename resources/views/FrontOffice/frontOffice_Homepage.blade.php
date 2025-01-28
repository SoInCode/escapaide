@extends('FrontOffice.frontOffice_Template')
@vite(['resources/css/styleFrontOfficeHomepage.css', 'resources/js/accessibility.js', 'resources/css/styleFrontOfficeTemplate.css'])

@section('content')
<div class="container">

        <h2 class="lead"> <h1 id="grosTitre"><strong>Bienvenue sur notre plateforme d'entraide et d'inclusion</strong></h1><br>
   
        <main class="container my-5">
        <section>
            <h2 class="text-primary">Pourquoi cette plateforme ?</h2>
            <p>
                Face à l'isolement des personnes en situation de handicap, notamment les déficients visuels, 
                notre initiative vise à faciliter les rencontres, les échanges, et les sorties culturelles. 
                En rassemblant personnes valides et handicapées, nous cherchons à normaliser le handicap 
                dans la société et promouvoir une inclusion pleine et entière.
            </p>
        </section>

        <section class="mt-4">
            <h2 class="text-primary">Nos propositions :</h2>
            <ul>
                <li><strong>Événements culturels :</strong> Découvrez spectacles, concerts et expositions locaux directement sur notre interface.</li>
                <li><strong>Forums pour chaque rassemblement :</strong> Posez des questions sur l'accessibilité, organisez des sorties groupées, et discutez avec d'autres participants.</li>
                <li><strong>Accompagnement solidaire :</strong> Créez des liens humains grâce à un système de mise en relation entre personnes valides et celles ayant besoin d’assistance.</li>
                <li><strong>acceslibre© :</strong> Découvrez une carte intéractive pour trouver les lieux accessibles en partenariat avec la plateforme acceslibre©.</li>
            </ul>
        </section>

        <section class="mt-4">
            <h2 class="text-primary">Notre vision :</h2>
            <p>
                Au-delà des sorties, notre plateforme veut rompre l'isolement, encourager le partage, et valoriser chaque individu. 
                En rassemblant tous les publics sans distinction, nous œuvrons pour une société où le handicap est reconnu 
                comme une richesse et non un obstacle.
            </p>
        </section>

        <section class="mt-4 text-center">
            <h3 class="text-primary">Rejoignez-nous pour bâtir un avenir inclusif !</h3>
        </section>
    
    </div>


@endsection