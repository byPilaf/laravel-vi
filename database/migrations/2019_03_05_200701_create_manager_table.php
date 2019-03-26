<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table -> increments('id'); //自增主键
            $table -> string('username',20) -> notnull() -> comment('管理员账户');
            $table -> string('password',255) -> notnull() -> comment('密码');
            $table -> enum('gender',['男','女','保密']) -> notnull() -> default('保密') -> comment('性别');
            $table -> string('mobile',11) -> nullable() -> comment('手机号'); 
            $table -> string('email',40) -> nullable() -> comment('电子邮箱地址'); 
            $table -> tinyInteger('role_id') -> nullable() -> comment('角色id'); 
            $table -> timestamps();
            $table -> rememberToken();
            $table -> enum('status',['1','2']) -> notnull()-> default('2') -> comment('状态,1=禁用,2=启用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager');
    }
}
