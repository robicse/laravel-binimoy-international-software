<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->integer('supplier_id');
            $table->string('passenger_details_id');
            $table->string('group_id');
            $table->string('v_issue_date')->nullable();
            $table->string('visa_no')->nullable();
            $table->string('id_number')->nullable();
            $table->string('office')->nullable();
            $table->string('finger')->nullable();
            $table->string('tc')->nullable();
            $table->string('mp')->nullable();
            $table->string('pc')->nullable();
            $table->string('photo')->nullable();
            $table->string('flight')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
