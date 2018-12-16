<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment("用户ID");
            $table->string('user_name')->nullable()->comment("用户名称");
            $table->string('client_address')->nullable()->comment("用户请求地址");
            $table->longText('user_agent')->nullable()->comment("用户客户端");
            $table->string('path')->nullable()->comment("请求路径");
            $table->string('method')->nullable()->comment("请求方法");
            $table->longText('params')->nullable()->comment("请求参数");
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
        Schema::dropIfExists('operation_logs');
    }
}
