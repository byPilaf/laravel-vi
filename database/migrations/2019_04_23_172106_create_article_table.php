<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',500) -> notnull() -> comment('文章标题');
            $table->unsignedInteger('author_id') -> notnull() -> comment('作者(用户)id');         
            $table->text('article_content') -> notnull() -> comment('文章内容');         
            $table->unsignedtinyInteger('type_id') -> nullable() -> comment('文章类别id');
            $table->unsignedInteger('read_num') -> notnull() -> default(0) -> comment('文章阅读数');
            $table->unsignedInteger('favorites_num') -> notnull() -> default(0) -> comment('收藏数');   
            $table->enum('article_status',['1','2','3']) -> notnull() -> default('3') -> comment('状态,1=禁用,2=启用,3=待审核');      
            $table->timestamps();
        });

        //表注释
        DB::statement("ALTER TABLE `article` comment '文章表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
