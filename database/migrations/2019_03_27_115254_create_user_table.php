<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('mobile',11) -> notnull() -> comment('手机号'); 
            $table -> string('password',255) -> notnull() -> comment('用户密码');
            $table -> string('name',20) -> nullable() -> comment('用户昵称');
            $table -> string('avatarUrl',255) -> nullable() -> comment('用户头像路径');
            $table -> string('email',40) -> nullable() -> comment('电子邮箱地址'); 
            $table -> enum('status',['1','2']) -> notnull() -> default('2') -> comment('用户状态,1=停用,2=启用'); 
            $table -> timestamps();
            $table -> rememberToken();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
