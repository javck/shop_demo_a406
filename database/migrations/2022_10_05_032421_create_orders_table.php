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
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string('receiver', 10)->nullable(); //收件人姓名
            $table->string('receiverTitle', 10)->nullable(); //收件人頭銜
            $table->string('receiverMobile', 20)->nullable(); //收件人手機號碼
            $table->string('receiverEmail', 100)->nullable(); //收件人電子郵箱
            $table->string('receiverAddress', 100)->nullable(); //收件人地址
            $table->string('message', 500)->nullable(); //訊息
            $table->string('couponCode', 100)->nullable(); //優惠券序號
            $table->integer('subtotal')->default(0); //訂單金額
            $table->integer('shipCost')->default(0); //運費
            $table->string('status', 20)->default('create'); //訂單狀態，包含 create 建立 paid 已付款 done 已完成 canceled 已取消
            $table->string('pay_type', 100)->nullable(); //付款類型
            $table->string('trade_no', 100)->nullable(); //金流序號
            $table->timestamp('pay_at')->nullable(); //付款時間
            $table->string('reply_desc', 255)->nullable(); //回覆給客戶的訊息
            $table->string('type', 255)->default('normal'); //類型
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
};
