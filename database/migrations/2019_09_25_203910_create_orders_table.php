<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id')->unique();
            $table->string('image')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('payment')->nullable(); // cong thanh toan
            $table->text('payment_info')->nullable();
            $table->longText('customer_notes')->nullable();
            $table->longText('notes')->nullable();
            $table->string('security')->nullable();
            $table->float('amount');
            $table->float('score_awards')->default(0);
            $table->float('promotion')->default(0);
            $table->integer('user_id_status_pending')->nullable();
            $table->integer('user_id_status_shipped')->nullable();
            $table->integer('user_id_status_delivered')->nullable();
            $table->integer('user_id_status_cancel')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
