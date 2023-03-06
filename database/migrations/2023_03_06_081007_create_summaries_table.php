<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('reference_id');
            $table->integer('series_id');
            $table->string('ris_num');
            $table->string('entity_name');
            $table->string('cluster');
            $table->string('supplier');
            $table->string('papcode');
            $table->string('division');
            $table->string('respo_center');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('stock_number');
            $table->string('description');
            $table->string('item');
            $table->string('unit');
            $table->double('cost');
            $table->integer('quantity');
            $table->integer('isavail');
            $table->integer('available');
            $table->integer('partial');
            $table->integer('partialy_serve');
            $table->bigInteger('partial_quantity');
            $table->string('category');
            $table->string('type');
            $table->string('supply_type');
            $table->integer('complete');
            $table->integer('serve');
            $table->integer('consume_days');
            $table->string('remarks');
            $table->string('image');
            $table->string('report_date');
            $table->integer('re_order');
            $table->string('requested_by');
            $table->string('requested_by_pos');
            $table->string('prop_num');
            $table->date('date_receive');
            $table->string('cy');
            $table->string('par_ics_series');
            $table->integer('physical_count');
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
        Schema::dropIfExists('summaries');
    }
}
