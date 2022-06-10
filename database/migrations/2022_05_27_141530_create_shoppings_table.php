<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->string('shipping_name');
            // $table->integer('customer_id');
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('shipping_email');
            $table->string('shipping_address');
            $table->integer('shipping_phone');
            $table->string('shipping_desc')->is_null();
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
        Schema::dropIfExists('shoppings');
    }
}
