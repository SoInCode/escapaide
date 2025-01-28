<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        
        
        // Table roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_roles');
            $table->string('roles');
            $table->timestamps();
        });
        
        // Table Utilisateurs
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_user'); // Cette colonne est la clé primaire
            $table->string('identifiant', 50);
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('mot_de_passe', 100);
            $table->string('email', 100);
            $table->string('numero_de_telephone');
            $table->tinyInteger('age');
            $table->string('localisation', 100)->nullable();
            $table->string('centres_d_interet', 200)->nullable();
            $table->string('type_aides', 200)->nullable();
            $table->string('accessibilite_specifique', 200)->nullable();
            $table->unsignedBigInteger('id_roles')->nullable();
            $table->foreign('id_roles')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Table Flux_rss
        Schema::create('flux_rss', function (Blueprint $table) {
            $table->id(); // COUNTER
            $table->string('nom_flux', 500)->nullable();
            $table->string('adresse_flux', 500);
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Table Departement
        Schema::create('departements', function (Blueprint $table) {
            $table->id('id_departement'); // COUNTER
            $table->string('num_departement', 50);
            $table->string('nom_departement', 150)->nullable();
            $table->string('lien_image', 150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Table Forum
        Schema::create('forums', function (Blueprint $table) {
            $table->string('id_forum', 150)->primary();
            $table->string('nom_forum', 150)->nullable();
            $table->string('description_forum', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Table Messages
        Schema::create('messages', function (Blueprint $table) {
            $table->string('id_message', 50)->primary();
            $table->string('id_discussion', 50)->nullable();
            $table->string('contenu', 50);
            $table->dateTime('date_ecriture')->nullable();
            $table->dateTime('date_modification')->nullable();
            $table->string('id_forum', 150);
            $table->foreign('id_forum')->references('id_forum')->on('forums')->onDelete('cascade');
            $table->unsignedBigInteger('id_user'); // Utiliser un entier non signé pour la référence
            $table->foreign('id_user')->references('id_user')->on('utilisateurs')->onDelete('cascade'); // Correction ici
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Table Session
        Schema::create('session', function (Blueprint $table) {
            $table->string('id_session', 50)->primary();
            $table->string('token', 500);
            $table->unsignedBigInteger('id_user')->unique();
            $table->foreign('id_user')->references('id_user')->on('utilisateurs')->onDelete('cascade'); // Correction ici
            $table->timestamps();
            $table->softDeletes();
        });
        
        
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('forums');
        Schema::dropIfExists('departements');
        Schema::dropIfExists('flux_rss');
        Schema::dropIfExists('utilisateurs');
    }
};