<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 菜单类别  -> 菜品分类 -> 菜单 远程一对多
        Schema::create('menu_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->comment("店铺ID");
            $table->string('name')->comment("菜单名称");
            $table->integer('order')->default(1)->comment("排序");
            $table->boolean('is_recommend')->default(0)->comment("是否推荐");
            $table->boolean('is_hot')->default(0)->comment("是否热搜");
            $table->string('working_date')->comment("开放时间,周一周五开放:1,2,3,4,5");
            $table->string('opening_time')->comment("展示时间,5:00,10:00");
            $table->string('serving_time')->comment("服务时间,7:00,10:00");
            $table->json('info')->nullable()->comment("其他");
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
        Schema::dropIfExists('menu_types');
    }
}
