<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairAndMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_and__maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('are_sticker');
            $table->string('pre_findings');
            $table->string('pre_recommendation');
            $table->string('pre_inspector');
            $table->date('pre_date_inspector');
            $table->string('job_order');
            $table->date('post_date_job');
            $table->string('invoice');
            $table->date('post_date_invoice');
            $table->double('amount');
            $table->double('payable');
            $table->string('post_findings');
            $table->string('post_inspector');
            $table->integer('repair_update')->default(0);
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
        Schema::dropIfExists('repair_and__maintenances');
    }
}
