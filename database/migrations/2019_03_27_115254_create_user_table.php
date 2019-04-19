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
            $table -> string('membername',20) -> nutnull() -> comment('会员账户名');
            $table -> string('password',255) -> notnull() -> comment('用户密码');
            $table -> string('name',20) -> nullable() -> comment('用户昵称');
            $table -> string('avatarUrl',255) -> nullable() -> comment('用户头像路径');
            $table -> string('email',40) -> nullable() -> comment('电子邮箱地址'); 
            $table -> enum('gender',['男','女','保密']) -> nutnull() -> default('保密') -> comment('性别');
            $table -> tinyInteger('country_id') -> nullable() -> comment('国家id');
            $table -> tinyInteger('province_id') -> nullable() -> comment('省份/地区id');
            $table -> tinyInteger('city_id') -> nullable() -> comment('城市id');
            $table -> tinyInteger('county_id') -> nullable() -> comment('区/县id');
            $table -> enum('type',['1','2']) -> notnull() -> default('1') -> comment('用户类型');
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
