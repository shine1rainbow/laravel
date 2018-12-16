<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //菜规格 必选
        Schema::create('menu_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->comment("菜ID");
            $table->string('name')->comment("规格名称: 王老吉");
            $table->double('price',4,2)->comment("单价");
            $table->integer("count")->default(0)->comment("数量");
            $table->string('introduction')->comment("说明");
            $table->json('info')->nullable()->comment("其他[尺寸，价格]");
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
        Schema::dropIfExists('menu_options');
    }
}
