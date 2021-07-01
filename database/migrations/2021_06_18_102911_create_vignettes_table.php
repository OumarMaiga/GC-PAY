<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVignettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vignettes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_chassis')->nullable();
            $table->string('numero_immatriculation')->nullable();
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
        Schema::dropIfExists('vignettes');
    }
}
