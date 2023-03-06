<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('ris_num')->nullable();
            $table->string('division')->nullable();
            $table->string('office')->nullable();
            $table->string('respo_center')->nullable();
            $table->string('papcode')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('requested_by_pos')->nullable();
            $table->date('date_request')->nullable();
            $table->string('approve_by')->nullable();
            $table->string('approve_by_pos')->nullable();
            $table->date('date_approve')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('issued_by_pos')->nullable();
            $table->date('date_issued')->nullable();
            $table->string('recieve_by')->nullable();
            $table->string('recieve_by_pos')->nullable();
            $table->date('date_receive')->nullable();
            $table->integer('complete')->default(0);
            $table->string('purpose')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
