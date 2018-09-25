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
            $table->string('nic', 13)->primary();
            $table->string('name', 60);
            $table->string('address_line_1', 30);
            $table->string('address_line_2', 30);
            $table->string('address_line_3', 50);
            $table->string('gender', 6);
            $table->string('birthday', 10);
            $table->string('contact_no', 10);
            $table->string('guardian_no', 10);
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
        Schema::dropIfExists('patients');
    }
}
