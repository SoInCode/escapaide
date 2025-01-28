<?php

use App\Http\Controllers\MeteoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AgendaCulturel;
use App\Http\Controllers\FluxRssController;
use App\Http\Controllers\AgendaCulturelController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\RassemblementController;
use App\Http\Controllers\BackOfficeFluxRss;
use App\Http\Controllers\BackOfficeUtilisateurController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;

use App\Http\Middleware\AdministrateurMiddleware;

// Route pour le FrontOffice
    // page d'accueil
Route::get('/', [SiteController::class, 'index'])->name('homepage.index');
    // page d'inscription
Route::get('/inscription', [UtilisateurController::class, 'create'])->name('user_inscription');
 // Route qui permet d'enregistrée un utilisateur
Route::post('/inscription', [UtilisateurController::class, 'store'])->name('user_Store');
    // page de connexion
Route::get('/connexion',[UtilisateurController::class, 'pageConnexion'])->name('user_page_Connexion');
    // route qui permet de lancer la connexion
Route::post('/connexion',[UtilisateurController::class, 'connexion'])->name('user_connexion');
    // page mon profil
Route::get('/Mon-Profil/{identifiant}',[UtilisateurController::class, 'index'])->middleware(['auth','verified'])->name('user_profil');
    // page pour se deconnécter
Route::get('/deconnexion',[UtilisateurController::class, 'deconnexion'])->middleware(['auth','verified'])->name('user_deconnexion');
    // page pour modifier son profil
Route::get('/modification/{identifiant}',[UtilisateurController::class, 'edit'])->middleware(['auth','verified'])->name('user_modifier');
    // route pour enregistrer les modifications de son profil
Route::put('/Mon-Profil/{identifiant}',[UtilisateurController::class,'update'])->middleware(['auth','verified'])->name('user_update');
    // route pour le soft-delete
Route::delete('actu/admin/{identifiant}',[UtilisateurController::class, 'destroy'])->middleware(['auth','verified'])->name('user_delete');


    // Route pour les threads
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/threads/{id}/{profil}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
Route::put('/threads/{id}/{profil}', [ThreadController::class, 'update'])->name('threads.update');
Route::put('/threads/{id}/show', [ThreadController::class, 'show'])->name('threads.show');
Route::delete('/threads/{id}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    // Route pour les posts
Route::get('/posts/{id}', [ThreadController::class, 'show'])->name('posts.show');
Route::post('/posts/store/{id}', [ThreadController::class, 'storePost'])->name('posts.store');
    // Route pour les flux rss
Route::get('flux_rss', [AgendaCulturelController::class, 'RSS'])->name('flux_rss');
    //Routes pour les Rassemblement
Route::resource('rassemblements', RassemblementController::class);
Route::get('/rassemblements/create', [RassemblementController::class, 'create'])->middleware(['auth', 'verified'])->name('rassemblements.create');
Route::delete('/rassemblements/{rassemblement}', [RassemblementController::class, 'destroy'])->name('rassemblements.destroy');
Route::get('/rassemblements/{id}/edit', [RassemblementController::class, 'edit'])->name('rassemblements.edit');
Route::put('/rassemblements/{id}', [RassemblementController::class, 'update'])->name('rassemblements.update');
Route::get('/rassemblements/{id}', [RassemblementController::class, 'show'])->name('rassemblements.show');
Route::post('/rassemblements/{id}/rejoindre', [RassemblementController::class, 'rejoindre'])->name('rassemblements.rejoindre');
Route::delete('/rassemblements/{id}/leave', [RassemblementController::class, 'leave'])->name('rassemblements.leave');
Route::post('/rassemblements/rechercher', [RassemblementController::class, 'rechercher'])->name('rassemblements.rechercher');
    
//Route pour le widget Meteo
Route::get('/meteo/{city?}', [MeteoController::class, 'getMeteo'])->name('meteo.widget');
Route::get('/meteo-ajax', [MeteoController::class, 'getMeteoAjax'])->name('meteo.ajax');


// Route pour le backOffice
Route::middleware([AdministrateurMiddleware::class])->group(function(){

    // Afficher
    Route::get('/admin', function(){ return view('BackOffice.backOffice_Homepage'); })->name('admin_Homepage');
    Route::get('/admin/Gestion-FluxRss', [BackOfficeFluxRss::class, 'index'])->name('Gestion_FluxRss');
    // Creer
    Route::get('/admin/Gestion-FluxRss/Create',[BackOfficeFluxRss::class, 'create'])->name('admin_FluxRss_Create');
    Route::post('/admin/Gestion-FluxRss/Create',[BackOfficeFluxRss::class, 'store'])->name('admin_FluxRss_Store');
    // Modifier
    Route::get('/admin/Gestion-FluxRss/Update/{id}',[BackOfficeFluxRss::class, 'edit'])->name('admin_FluxRSs_edit');
    Route::put('/admin/Gestion-FluxRss/{id}',[BackOfficeFluxRss::class, 'update'])->name('admin_FluxRss_Update');
    // Supprimer
    Route::delete('admin/Gestion-FluxRss/{id}' ,[BackOfficeFluxRss::class, 'destroy'])->name('admin_FluxRss_Destroy');
    // Afficher la liste des utilisateurs
    Route::get('admin/Utilisateur', [BackOfficeUtilisateurController::class, 'index'])->name('admin_Utilisateur_Index');
    // Route pour Soft-Delete un utilisateur
    Route::delete('admin/Utilisateur/{utilisateur}', [BackOfficeUtilisateurController::class, 'destroy'])->name('admin_Utilisateur_Destroy');
    
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
