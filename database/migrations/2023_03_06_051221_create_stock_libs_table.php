<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockLibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_libs', function (Blueprint $table) {
            $table->id();
            $table->string('stock_code');
            $table->string('description');
            $table->string('unit');
            $table->string('expense_category');
            $table->integer('reorderpoint');
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
        Schema::dropIfExists('stock_libs');
    }
}
