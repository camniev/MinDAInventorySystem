<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_settings', function (Blueprint $table) {
            $table->id();
            $table->string('RPCIInvCommitteeChair');
            $table->string('RPCIInvCommitteeMember');
            $table->string('RPCIOICChair');
            $table->string('RPCICOARep');
            $table->string('RPCIFinDivRep');
            $table->string('IARInpector');
            $table->string('IARInpectorPos');
            $table->string('IARSupplyOfficer');
            $table->string('IARSupplyOfficerPos');
            $table->date('assume_date');
            $table->string('RSMIAccClerk');
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
        Schema::dropIfExists('sign_settings');
    }
}
