<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueue4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue4', function (Blueprint $table) {
            $table->integer('number');
            $table->string('patient_id', 5);
            $table->timestamps();
            $table->primary(['number']);
            $table->foreign('patient_id')->references('patient_id')->on('appointments');
        });
        // DB::statement('ALTER TABLE queue4 CHANGE patient_id patient_id INT(4) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue4');
    }
}
