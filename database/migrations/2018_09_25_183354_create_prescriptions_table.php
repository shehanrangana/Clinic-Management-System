<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->integer('patient_id')->unsigned();
            $table->string('date', 10);
            $table->string('drug_name', 50);
            $table->integer('quantity');
            $table->timestamps();
            $table->primary(['patient_id', 'date', 'drug_name']);
            $table->foreign('patient_id')->references('patient_id')->on('patients');
            $table->foreign('drug_name')->references('name')->on('drugs');
        });
        DB::statement('ALTER TABLE prescriptions CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
        DB::unprepared('ALTER TABLE `prescriptions` DROP PRIMARY KEY, ADD PRIMARY KEY (  `patient_id` ,  `date`, `drug_name` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
