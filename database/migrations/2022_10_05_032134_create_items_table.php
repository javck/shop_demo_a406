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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100); //字串欄位，長度不超過100
            $table->string('pic',255);
            $table->text('desc')->nullable(); //長字串欄位，可為空值
            $table->integer('price')->default(0)->unsigned(); //整數欄位，預設為0，不得為負數
            $table->timestamp('sell_at')->nullable(); //時間戳記欄位，可為空值
            $table->boolean('enabled')->default(true); //布林值欄位，預設為true
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
        Schema::dropIfExists('items');
    }
};
