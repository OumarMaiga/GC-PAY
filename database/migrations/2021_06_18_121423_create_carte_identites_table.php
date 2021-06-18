<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteIdentitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_identites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('prenom_pere');
            $table->string('prenom_mere');
            $table->string('nom_mere');
            $table->string('adresse');
            $table->string('profession');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('prenom_pere');
            $table->string('prenom_pere');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carte_identites');
    }
}
