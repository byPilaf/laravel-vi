<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('authname',20) -> notnull() -> comment('权限名称');
            $table -> string('controller',50) -> notnull() -> comment('控制器名');
            $table -> string('action',20) -> nullable() -> comment('方法名');
            $table -> tinyInteger('pid') -> notnull() -> comment('父级权限id');
            $table -> enum('is_nav',['1','2']) -> notnull() -> comment('是否作为菜单显示,1=是,2=否');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth');
    }
}
