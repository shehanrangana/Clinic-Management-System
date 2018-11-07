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
            $table->string('date', 10);
            $table->string('timeslot', 5);
            $table->string('patient_id', 5);
            $table->boolean('flag')->default(0);
            $table->timestamps();
            $table->primary(['date', 'patient_id']);
            $table->foreign('patient_id')->references('patient_id')->on('patients');
        });
        // DB::statement('ALTER TABLE appointments CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
        // DB::unprepared('ALTER TABLE `appointments` DROP PRIMARY KEY, ADD PRIMARY KEY (  `date` ,  `patient_id` )');
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
