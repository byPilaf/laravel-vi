<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id') -> notnull() -> comment('文章id');          
            $table->unsignedInteger('user_id') -> notnull() -> comment('用户id');          
            $table->unsignedInteger('pid') -> notnull() -> default(0) -> comment('父级id,0为顶级评论');          
            $table->unsignedInteger('comment_like_number') -> notnull() -> default(0) -> comment('点赞数');          
            $table->string('comment_content',500) -> notnull() -> comment('评论内容');    
            $table->enum('comment_status',['1','2','3']) -> notnull() -> default('2') -> comment('状态,1=禁用,2=启用,3=被举报'); 
            $table->timestamps();
        });
        //表注释
        DB::statement("ALTER TABLE `comment` comment '评论表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
