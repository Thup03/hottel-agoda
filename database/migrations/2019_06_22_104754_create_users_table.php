<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('birthday');
            $table->tinyInteger('gender')->default(1);
            $table->string('indetity_cart')->nullable();
            $table->string('phone_number');
            $table->string('address');
            $table->string('active_code')->nullable();  
            $table->string('email')->unique();
            $table->string('email_verified_at')->nullable();
            $table->string('password');
            $table->float('score_awards')->default(0);
            $table->float('money_payment_transactions')->default(0);
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('flag')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
