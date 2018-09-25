<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->string('timeslot', 5);
            $table->integer('number');
            $table->integer('total');
            $table->integer('current');
            $table->string('patient_nic', 13);
            $table->timestamps();
            $table->primary(['timeslot', 'number']);
            $table->foreign('patient_nic')->references('patient_nic')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queues');
    }
}
