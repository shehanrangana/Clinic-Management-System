<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->string('patient_id', 5)->default("0000")->primary();
            $table->string('name', 60);
            $table->string('address_line_1', 30);
            $table->string('address_line_2', 30);
            $table->string('address_line_3', 50);
            $table->string('nic', 13)->unique();
            $table->string('gender', 6);
            $table->string('birthday', 10);
            $table->string('contact_no', 10);
            $table->string('guardian_no', 10);
            $table->timestamps();
        });
        // DB::statement('ALTER TABLE patients CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL auto_increment');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
