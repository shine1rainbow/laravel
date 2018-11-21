<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->comment('员工昵称');
            $table->string('first_name')->comment('员工姓');
            $table->string('last_name')->comment('员工名');
            $table->string('position')->comment('职位');
            $table->string('actions')->comment('操作');
            $table->string('avater')->comment('头像');
            $table->string('age')->comment('年龄');
            $table->string('phone')->comment('手机号');
            $table->string('gender')->comment('性别');
            $table->json('info')->nullable()->comment('其他信息');
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
        Schema::dropIfExists('staffs');
    }
}
