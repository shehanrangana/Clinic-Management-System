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
            $table->string('patient_nic', 13);
            $table->string('date', 10);
            $table->string('drug_name', 50);
            $table->integer('quantity');
            $table->timestamps();
            $table->primary(['patient_nic', 'date', 'drug_name']);
            $table->foreign('patient_nic')->references('nic')->on('patients');
            $table->foreign('drug_name')->references('name')->on('drugs');
        });
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
