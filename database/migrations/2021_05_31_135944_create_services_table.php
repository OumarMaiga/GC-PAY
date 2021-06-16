<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Structure;
use App\Models\User;
use App\Models\Rubrique;
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
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('duree')->nullable();
            $table->string('prix')->nullable();
            $table->string('type')->nullable();
            $table->boolean('etat')->default(true);
            $table->foreignId('admin_systeme_id')->default('0');
            $table->foreignId('rubrique_id')->nullable();
            
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
