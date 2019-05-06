<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\Comment;

class CommentController extends Controller
{
    //查看文章中的评论
    public function articleComment(Request $request)
    {
        //获取文章id
        $articleId = $request -> get('id');
        $data = Comment::where('article_id',$articleId) -> where('comment_status','<>','1')-> get();
        //返回视图
        return view('admin.comment.articleComment',compact('data'));
    }
}
