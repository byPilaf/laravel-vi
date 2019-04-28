<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('typename',20) -> notnull() -> comment('文章类别名');
            $table->unsignedtinyInteger('pid') -> notnull() -> comment('父级类别id');
            $table -> enum('display',['显示','隐藏']) -> notnull() -> default('显示') -> comment('是否作为导航显示');
        });

        //表注释
        DB::statement("ALTER TABLE `article_type` comment '文章类别表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_type');
    }
}
