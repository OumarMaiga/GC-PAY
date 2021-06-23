<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requetes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('usager_id')->references('id')->on('users');
            $table->boolean('paye')->default(false);
            $table->string('etat')->default("En cours");
            $table->string('code')->nullable();
            $table->string('montant')->nullable();
            $table->foreignId('structure_id')->references('id')->on('structures')->nullable();
            $table->foreignId('service_id')->references('id')->on('services')->nullable();
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
        Schema::dropIfExists('requetes');
    }
}
