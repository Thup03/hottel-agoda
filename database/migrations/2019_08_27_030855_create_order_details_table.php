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
			$table->integer('product_id');
            $table->string('name');
            $table->string('slug');
			$table->string('code');
			$table->integer('quantity')->default(0);
            $table->float('price');
            $table->float('price_sale');
			$table->string('payment')->nullable(); // cong thanh toan
			$table->integer('status')->default(0);
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
