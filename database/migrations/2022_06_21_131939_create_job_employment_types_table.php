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
        Schema::create('job_employment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_job');
            $table->foreign('id_job')->references('id')->on('jobs');
            $table->unsignedInteger('id_employment_type');
            $table->foreign('id_employment_type')->references('id')->on('employment_types');
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
        Schema::dropIfExists('job_employment_types');
    }
};
