<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //菜单
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_category_id')->unsigned()->comment("菜品分类");
            $table->string('menu_name')->index()->comment("菜品名称");
            $table->string('menu_no')->nullable()->comment("菜品编号");
            $table->string('avater')->nullable()->comment("菜单封面图");
            $table->string('detail_img')->nullable()->comment("菜单详细图");
            $table->double('price',4,2)->default(0)->nullable()->comment("菜品编号");
            $table->integer('number')->default(0)->comment("菜数量");
            $table->integer('status')->default(1)->comment("售罄/有货");
            $table->integer('spicy')->default(0)->comment("辣度");
            $table->integer('order')->default(1)->comment("顺序");
            $table->boolean('is_recommend')->default(0)->comment("是否推荐");
            $table->boolean('is_hot')->default(0)->comment("是否热搜");
            $table->longText('introduction')->nullable()->comment("菜介绍");
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
        Schema::dropIfExists('menus');
    }
}
