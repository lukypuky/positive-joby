<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontakts', function (Blueprint $table) {
            $table->increments('id_kontakty');
            $table->integer('typ_kontaktu');
            $table->unsignedInteger('id_job');
            $table->foreign('id_job')->references('id_job')->on('jobs')->nullable();
            $table->string('meno_priezvisko');
            $table->string('telefon');
            $table->string('email');
            $table->string('sprava');
            $table->binary('priloha');
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
        Schema::dropIfExists('kontakts');
    }
};
