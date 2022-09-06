<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemriresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemriresponses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alert_id');
            $table->date('specimen_received');
            $table->string('specimen_type');
            $table->string('specimen_type_other');
            $table->string('specimen_condition');
            $table->string('specimen_condition_other');
            $table->string('specimen_results');
            $table->string('comments');
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
        Schema::dropIfExists('kemriresponses');
    }
}
