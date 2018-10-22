<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->string('date', 10)->primary();
            $table->string('timeslot', 5);
            $table->integer('patient_id')->unsigned();
            $table->timestamps();
            $table->foreign('patient_id')->references('patient_id')->on('patients');
        });
        DB::statement('ALTER TABLE appointments CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
        DB::unprepared('ALTER TABLE `appointments` DROP PRIMARY KEY, ADD PRIMARY KEY (  `date` ,  `patient_id` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
