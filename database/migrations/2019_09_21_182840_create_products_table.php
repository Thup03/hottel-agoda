<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name'); // ten san pham
            $table->text('slug'); // duong dan
            $table->string('code'); // ma san pham
            $table->integer('type'); // loai san pham
            $table->integer('pathology_id')->nullable(); // id benh hoc
            $table->integer('pharmacology_id')->nullable(); // dang duoc ly
            $table->integer('pharmacy_id')->nullable(); // dang bao che
            $table->integer('manufacturer_id')->nullable(); // nha san xuat
            $table->integer('support_treatment_id')->nullable(); // nhom ho tro dieu tri
            $table->integer('utility_id')->nullable(); // nhom cong dung
            $table->string('registration_number')->nullable(); // so dang ki
            $table->longText('description')->nullable(); // mo ta san pham
            $table->longText('active')->nullable(); // hoat chat
            $table->longText('appointed')->nullable(); // chi dinh
            $table->longText('dosage')->nullable(); // lieu luong
            $table->longText('frequence')->nullable(); // cach su dung

            $table->text('packed')->nullable(); // cach dong goi
            $table->text('effect')->nullable(); // tac dung
            $table->text('maintain')->nullable(); // bao quan
            $table->text('contradication')->nullable(); // chong chi dinh
            $table->text('object')->nullable(); // doi tuong su dung
            $table->string('image'); // hinh anh san pham
            $table->float('price'); // gia
            $table->integer('unit'); // don vi tinh
            $table->float('price_sale'); // giam gia
            $table->integer('quantity'); // so luong san pham trong kho
            $table->integer('required_prescription')->default(0);; // yeu cau don thuoc
            $table->integer('user_id'); // nguoi dang
            $table->integer('bought')->default(0);; // so lan mua
            $table->integer('view_count')->default(0);; // so luot xem

            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
