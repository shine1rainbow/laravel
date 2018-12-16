<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //图片资源
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->default('')->comment('图片路径');
            $table->integer('user_id')->unsigned()->comment('用户ID');
            $table->integer('tag_id')->unsigned()->default(1)->comment('标签ID');
            $table->integer('order')->default(1)->comment('图片权重');
            $table->string('desc')->nullable()->comment('图片描述');
            $table->softDeletes();
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
        Schema::dropIfExists('pictures');
    }
}
