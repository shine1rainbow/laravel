<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //购物车
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('shop_id');
			$table->integer('desk_id');
			$table->integer('menu_id');
			$table->integer('numbers')->default(1)->comment('商品的数量');
			$table->json('menu_option')->nullable()->comment("辅菜信息");
			$table->json('menu_addition')->nullable()->comment("加菜信息");
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
        Schema::dropIfExists('shopping_carts');
    }
}
