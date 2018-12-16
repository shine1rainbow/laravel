<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //配菜 可选
        Schema::create('menu_additions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->comment("菜ID");
            $table->string('name')->comment("规格名称: 双倍牛肉");
            $table->double('price',4,2)->comment("单价");
            $table->integer("count")->default(0)->comment("数量");
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
        Schema::dropIfExists('menu_additions');
    }
}
