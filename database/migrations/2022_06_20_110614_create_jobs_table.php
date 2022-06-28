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
            $table->increments('id');
            $table->string('position_name');
            $table->string('slug');
            $table->unsignedInteger('id_experience');
            $table->foreign('id_experience')->references('id')->on('experiences');
            $table->unsignedInteger('id_homeoffice');
            $table->foreign('id_homeoffice')->references('id')->on('homeoffices');
            $table->unsignedInteger('id_salary_type');
            $table->foreign('id_salary_type')->references('id')->on('salary_types');
            $table->integer('salary_from');
            $table->integer('salary_to')->nullable();
            $table->text('description');
            $table->text('expectation');
            $table->text('benefits');
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
