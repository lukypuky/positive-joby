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
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id_job');
            $table->string('nazov_pozicie');
            $table->string('slug');
            $table->unsignedInteger('id_druh_pracovneho_pomeru');
            $table->foreign('id_druh_pracovneho_pomeru')->references('id_druh_pracovneho_pomeru')->on('druh_pracovneho_pomerus');
            $table->unsignedInteger('id_skusenosti');
            $table->foreign('id_skusenosti')->references('id_skusenosti')->on('skusenosts');
            $table->unsignedInteger('id_praca_z_domu');
            $table->foreign('id_praca_z_domu')->references('id_praca_z_domu')->on('praca_z_domus');
            $table->unsignedInteger('id_typ_platu');
            $table->foreign('id_typ_platu')->references('id_typ_platu')->on('typ_platus');
            $table->integer('plat_od');
            $table->integer('plat_do');
            $table->text('popis');
            $table->text('ocakavanie');
            $table->text('benefity');
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
        Schema::dropIfExists('jobs');
    }
};
