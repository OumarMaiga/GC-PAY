<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable();
            $table->text('description')->nullable();
            $table->string('duree')->nullable();
            $table->decimal('prix')->nullable();
            $table->string('etat')->nullable();
            $table->foreignId('admin_systeme_id')->default('0');
            //$table->unsignedBigInteger('admin_systeme_id')->nullable();
            //$table->foreign('admin_systeme_id')->references('id')->on('user');
            $table-> unsignedBigInteger('structure_id')->nullable(); 
            $table->foreign('structure_id')->references('id')->on('structures');
            $table->unsignedBigInteger('rubrique_id')->nullable();
            
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
        Schema::dropIfExists('services');
    }
}
