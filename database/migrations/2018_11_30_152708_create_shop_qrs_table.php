<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_qrs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->comment('店铺ID');
            $table->string('app_qr')->nullable()->comment('APP二维码');
            $table->string('wechat_qr')->nullable()->comment('店内微信二维码,一桌一个');
            $table->string('wechat_introduction_qr')->nullable()->comment('餐厅介绍二维码');
            $table->json('info')->nullable()->comment('其他');
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
        Schema::dropIfExists('shop_qrs');
    }
}
