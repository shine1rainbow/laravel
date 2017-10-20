<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('关联用户主表ID');
            $table->string('name')->comment('平台名称');
            $table->string('key')->comment('各平台用户标识，如微信的openid');
            $table->string('key_extra')->unique()->nullable()->comment('配合key需要的额外信息，用户标识.如微信的union_id');
            $table->string('description')->nullable()->comment('平台描述');
            $table->json('info')->nullable()->comment('额外信息:性别,年龄');
            $table->softDeletes()->comment('软删除');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // 外键关联
            $table->foreign('user_id')
                ->references('id') ->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
