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
        $articleId = (int) $request -> get('id');
        //此文章下的所有顶级评论
        $data = Comment::where('article_id',$articleId) -> where('comment_status','<>','1')-> where('pid','0') -> get();
        //获取其子评论
        //返回视图
        return view('admin.comment.articleComment',compact('data'));
    }

    //评论列表
    public function index()
    {
        //获取数据
        $data = Comment::where('comment_status','<>','1') -> get();
        //展示视图
        return view('admin.comment.index',compact('data'));
    }

    //待审核评论列表
    public function review()
    {
        $data = Comment::where('comment_status','3') -> get();
        return view('admin.comment.index',compact('data'));
    }

    //下架的评论列表
    public function notPassCommentList()
    {
        $data = Comment::where('comment_status','1') -> get();
        return view('admin.comment.index',compact('data'));
    }

    //查看评论详情
    public function page(Request $request)
    {
        //获取id
        $id = (int) $request -> get('id');
        $comment = Comment::find($id);
        return view('admin.comment.page',compact('comment'));
    }

    //评论启用
    public function start(Request $request)
    {
        $id = $request -> only('id');
        $data['comment_status'] = 2;
        $request = Comment::where('id',$id) -> update($data);

        //判断是否成功
        if($request)
        {
            $response = ['code' => '0','msg' => '启用成功'];
        }
        else
        {
            $response = ['code' => '1','msg' => '启用失败'];
        }
        return response() -> json($response);
    }
    
    //评论停用
    public function stop(Request $request)
    {
        $id = $request -> only('id');
        $data['comment_status'] = 1;
        $request = Comment::where('id',$id) -> update($data);

        //判断是否成功
        if($request)
        {
            $response = ['code' => '0','msg' => '停用成功'];
        }
        else
        {
            $response = ['code' => '1','msg' => '停用失败'];
        }
        return response() -> json($response);
    }

    //评论删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = Comment::where('id',$id) -> delete();

        //判断是否成功
        if($request)
        {
            $response = ['code' => '0','msg' => '删除成功'];
        }
        else
        {
            $response = ['code' => '1','msg' => '删除失败'];
        }
        return response() -> json($response);
    }
}
