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
            $table->integer('patient_id')->unsigned();
            $table->timestamps();
            $table->primary(['timeslot', 'number']);
            $table->foreign('patient_id')->references('patient_id')->on('appointments');
        });
        DB::statement('ALTER TABLE queues CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
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
