<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionAndAcceptancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_and__acceptances', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('cluster');
            $table->string('supplier');
            $table->string('po_number');
            $table->string('department');
            $table->string('responsibility_code');
            $table->string('papcode');
            $table->string('iar_no')->nullable();
            $table->date('iar_date')->nullable();
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('inspector')->nullable();
            $table->date('date_inspected')->nullable();
            $table->string('receiver')->nullable();
            $table->date('date_receive')->nullable();
            $table->integer('iscomplete');
            $table->integer('is_updated');
            $table->string('type')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('inspection_and__acceptances');
    }
}
