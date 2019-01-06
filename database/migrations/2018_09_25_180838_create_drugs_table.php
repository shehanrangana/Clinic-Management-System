<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('drug_id');
            $table->string('name', 50)->index();
            $table->string('brand', 30);
            $table->integer('quantity');
            $table->boolean('isLiquid')->default(0); // 0-tablet 1-liquid
            $table->timestamps();
            $table->string('expire_date', 10);
            $table->string('supplier_email', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
