<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Queue3Trigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER after_queue3_update AFTER INSERT ON queue3 FOR EACH ROW
        BEGIN
            UPDATE queue_summary 
            SET
            total = total+1
            WHERE timeslot = "10-11";
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
