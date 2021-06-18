<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->references('id')->on('entreprises');
            $table->integer('montant_declarer');
            $table->integer('montant_payer');
            $table->foreignId('requete_id')->references('id')->on('requetes');
            $table->string('periode');
            $table->string('libelle');
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
        Schema::dropIfExists('impots');
    }
}
