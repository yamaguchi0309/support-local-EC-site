<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); # 外部キー
            $table->foreign('user_id')->references('id')->on('users'); # 外部キー制約をつける
            $table->string('shipping_tel');
            $table->string('shipping_postcode');
            $table->string('shipping_address');
            $table->integer('amount');
            $table->integer('postage');
            $table->tinyInteger('shipping_status');
            $table->tinyInteger('order_status');
            $table->tinyInteger('payment_status');
            $table->string('payment_method');
            $table->text('memo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    // $table->unsignedBigInteger('customer_id'); # 外部キー
    // $table->foreign('customer_id')->references('id')->on('Customer'); # 外部キー制約をつける

    // $table->bigInteger('user_id')->unsigned();
    // $table->foreign('user_id')->references('id')->on('users');


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
