<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('	invoice_id');
            $table->string('agent_id');
            $table->string('quantity');
            $table->string('per_piece_price');
            $table->string('total_price');
            $table->string('pay_amount');
            $table->string('due_amount');
            $table->string('date');
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
        Schema::dropIfExists('visa_stocks');
    }
}
