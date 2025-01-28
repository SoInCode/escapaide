<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/xxxx_xx_xx_create_threads_table.php
public function up()
{
    Schema::create('threads', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Titre du sujet
        $table->text('body'); // Contenu initial du sujet
        $table->unsignedBigInteger('category_id'); // Colonne pour la clé étrangère
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        $table->unsignedBigInteger('id_user'); // Colonne pour l'utilisateur
        $table->foreign('id_user')->references('id_user')->on('utilisateurs')->onDelete('cascade');
        $table->softDeletes();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
