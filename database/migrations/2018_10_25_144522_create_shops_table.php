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
            $table->integer('user_id')->unsigned()->default(1)->comment('用户ID');
            $table->integer('city_id')->unsigned()->nullable()->comment('城市ID');
            $table->integer('shop_tag_id')->unsigned()->nullable()->comment('店铺分类ID');
            $table->string('restaurant_name')->comment('商家名称');
            $table->string('restaurant_logo')->nullable()->comment('商家Logo');
            $table->string('restaurant_background')->nullable()->comment('App商家背景图片');
            $table->string('food_type')->nullable()->comment('食物类别');
            $table->double('lat', 8,8)->nullable()->comment('经度');
            $table->double('lng', 8,8)->nullable()->comment('纬度');
            $table->string('email')->nullable()->unique()->comment('邮箱');
            $table->string('mobile')->nullable()->unique()->comment('手机号');
            $table->string('landline')->nullable()->comment('座机号');
            $table->string('address')->nullable()->comment('城市');
            $table->string('postcode')->nullable()->comment('邮编');
            $table->double('service_charge', 4, 2)->nullable()->comment('服务费');
            $table->string('payment_sequence')->nullable()->comment('支付顺序');
            $table->string('vat_reg_no')->nullable()->comment('税号');
            $table->string('avg_consumption')->nullable()->comment('平均消费');
            $table->string('images')->nullable()->comment('图片');
            $table->longText('introduction')->nullable()->comment('介绍');
            $table->string('remind')->nullable()->comment('温馨提示');
            $table->string('activity')->nullable()->comment('优惠活动');
            $table->integer('shop_status_id')->unsigned()->default(1)->comment('门店状态');
            $table->string('shop_qr')->nullable()->comment('店铺总二维码');
            $table->json('business_hour')->nullable()->comment('工作时间(7天): 09:00-21:00,09:00-20:30,...,歇业');
            $table->boolean('is_recommend')->default(0)->comment("是否推荐");
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
