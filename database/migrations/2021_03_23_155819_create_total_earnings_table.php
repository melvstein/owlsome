<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_earnings', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            /* $table->string('item_name');
            $table->integer('quantity');
            $table->float('price'); */
            $table->string('shipping_fee');
            $table->string('amount');
            $table->float('earned');
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
        Schema::dropIfExists('total_earnings');
    }
}
