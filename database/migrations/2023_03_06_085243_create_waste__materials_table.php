<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste__materials', function (Blueprint $table) {
            $table->id();
            $table->string('wm_num');
            $table->string('entity_name');
            $table->string('cluster');
            $table->string('storage');
            $table->date('wm_date');
            $table->string('custodian')->nullable();
            $table->string('agency_head')->nullable();
            $table->integer('is_destroyed');
            $table->integer('private_sale');
            $table->integer('public_auction');
            $table->integer('transferred');
            $table->string('agency_name')->nullable();
            $table->string('inspection_officer')->nullable();
            $table->string('witness')->nullable();
            $table->integer('isok');
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
        Schema::dropIfExists('waste__materials');
    }
}
