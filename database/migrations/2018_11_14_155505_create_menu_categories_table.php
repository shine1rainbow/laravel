<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //菜品分类
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_type_id')->unsigned()->comment("菜单大分类");
            $table->string('name')->comment("菜品分类");
            $table->integer('order')->default(1)->comment("排序");
            $table->longText('introduction')->nullable()->comment("介绍");
            $table->boolean('is_recommend')->default(0)->comment("是否推荐");
            $table->boolean('is_hot')->default(0)->comment("是否热搜");
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
        Schema::dropIfExists('menu_categories');
    }
}
