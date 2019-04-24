<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_auth', function (Blueprint $table) {
            $table -> unsignedtinyInteger('role_id') -> nullable() -> comment('角色id');
            $table -> unsignedtinyInteger('auth_id') -> nullable() -> comment('权限id');
        });

        //表注释
        DB::statement("ALTER TABLE 'role_auth' comment'管理员角色表与管理员权限对应表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_auth');
    }
}
