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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_id'); // Colonne pour la clé étrangère
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            $table->unsignedBigInteger('id_user'); // Colonne pour l'utilisateur
            $table->foreign('id_user')->references('id_user')->on('utilisateurs')->onDelete('cascade');
            $table->text('body');
            $table->softDeletes();
            $table->timestamps();
        
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
