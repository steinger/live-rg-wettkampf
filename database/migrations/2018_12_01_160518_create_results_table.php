<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->nullable()->unsigned(); // foreign
            $table->foreign('event_id')->references('id')->on('events');
            $table->string('rgid',6);
            $table->string('apparatus_short',2);
            $table->integer('startno');
            $table->string('name');
            $table->string('category',3);
            $table->string('competition_type',2);
            $table->string('apparatus',20);
            $table->float('f_score',5,3);
            $table->string('d_score',5);
            $table->string('e_score',5);
            $table->string('penalty',20);
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
        Schema::dropIfExists('results');
    }
}
