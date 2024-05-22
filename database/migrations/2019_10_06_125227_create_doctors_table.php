<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar');
            $table->string('name');
            $table->string('link');
            $table->string('birthday')->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->string('indetity_cart')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('job')->nullable();
            $table->string('position')->nullable();
            $table->longText('description')->nullable();
            // diem chuyen mon
            $table->integer('professional_points')->default(0);
            // diem danh gia
            $table->integer('review')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('doctors');
    }
}
