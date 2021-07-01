<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->integer('montant');
            $table->string('slug');
            $table->foreignId('structure_id')->references('id')->on('structures');
            $table->foreignId('usager_id')->references('id')->on('users');
            $table->foreignId('service_id')->references('id')->on('services');
            $table->foreignId('entreprise_id')->nullable()->references('id')->on('entreprises');
            $table->foreignId('requete_id')->references('id')->on('requetes');
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
        Schema::dropIfExists('paiements');
    }
}
