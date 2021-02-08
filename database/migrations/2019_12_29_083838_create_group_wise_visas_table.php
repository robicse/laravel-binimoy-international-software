<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupWiseVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_wise_visas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('visa_stock_id');
            $table->string('agent_id');
            $table->string('group_id');
            $table->string('quantity');
            $table->string('per_piece_price');
            $table->string('total_price');
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
        Schema::dropIfExists('group_wise_visas');
    }
}
