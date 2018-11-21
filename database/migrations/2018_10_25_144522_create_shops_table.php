<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('restaurant_name')->comment('商家名称');
            $table->string('restaurant_logo')->comment('商家Logo');
            $table->string('restaurant_background')->comment('App商家背景图片');
            $table->string('food_type')->comment('食物类别');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('mobile')->unique()->comment('手机号');
            $table->string('landline')->comment('座机号');
            $table->string('address')->comment('城市');
            $table->string('postcode')->comment('邮编');
            $table->string('service_charge')->comment('服务费');
            $table->string('payment_sequence')->comment('支付顺序');
            $table->string('vat_reg_no')->comment('税号');
            $table->string('images')->comment('图片');
            $table->longText('introduction')->comment('介绍');
            $table->string('remind')->comment('温馨提示');
            $table->string('activity')->comment('优惠活动');
            $table->json('business_hour')->comment('工作时间(7天): 09:00-21:00,09:00-20:30,...,歇业');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
