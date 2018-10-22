<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_reports', function (Blueprint $table) {
            $table->increments('report_id');
            $table->integer('patient_id')->unsigned();
            $table->string('test', 30);
            $table->string('file', 30);
            $table->timestamps();
            $table->foreign('patient_id')->references('patient_id')->on('patients');
        });
        DB::statement('ALTER TABLE lab_reports CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_reports');
    }
}
