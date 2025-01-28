<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rassemblements', function(Blueprint $table)
        {
            $table->id('id_rassemblement');
            $table->string('nom', 150);
            $table->string('description', 500);
            $table->string('localisation', 150);
            $table->string('ville', 100);
            $table->dateTime('date_rassemblement');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('utilisateurs')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rassemblements');
    }
};
