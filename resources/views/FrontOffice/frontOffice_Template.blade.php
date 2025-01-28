<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <title>Escap'Aide</title>
    </head>
    <body>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/accessibility.js', 'resources/js/widget.js', 'resources/css/styleFrontOfficeTemplate.css'])
        
        <!-- Nav Bar-->
        <header>
            @include('FrontOffice.frontOffice_Navbar')
        </header>

        <!-- Corps de la page -->
        <div class="page-layout">

     <!-- Widget météo -->
    <div class="widget-container d-none d-xl-block">
    @include('FrontOffice.Meteo.widget')
</div> 

     <!-- Contenu principal -->
     <div class="col-12 col-md-8 content">
            @yield('content')
        </div>
</div>

        <!-- Footer -->
        <footer class="text-center mt-5 py-3">
            @include('FrontOffice.frontOffice_Footer')
        </footer>
        
    </body>
</html>