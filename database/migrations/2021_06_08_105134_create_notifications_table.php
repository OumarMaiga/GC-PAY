<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('destinateur')->nullable();
            $table->string('slug')->unique();
            $table->boolean('vue')->default(false);
            $table->foreignId('requete_id')->references('id')->on('requetes')->nullable();
            $table->foreignId('structure_id')->references('id')->on('structures')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
