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
            $table->foreignId('requete_id')->nullable()->references('id')->on('requetes');
            $table->foreignId('structure_id')->nullable()->references('id')->on('structures');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
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
