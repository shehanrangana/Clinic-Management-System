<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueueSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_summary', function (Blueprint $table) {
            $table->string('timeslot', 5)->primary();
            $table->integer('total');
            $table->integer('current');
            $table->boolean('status')->default(0);
            $table->integer('panel_1')->default(0);
            $table->integer('panel_2')->default(0);
            $table->integer('panel_3')->default(0);
            $table->integer('panel_4')->default(0);
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
        Schema::dropIfExists('queue_summary');
    }
}
