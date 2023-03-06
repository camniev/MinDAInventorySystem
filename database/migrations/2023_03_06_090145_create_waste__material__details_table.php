<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste__material__details', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('wm_id');
            $table->string('item');
            $table->string('quantity');
            $table->string('unit');
            $table->string('description');
            $table->string('receipt_num');
            $table->date('receipt_date');
            $table->double('amount');
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
        Schema::dropIfExists('waste__material__details');
    }
}
