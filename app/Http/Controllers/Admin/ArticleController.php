<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Model\Article;
use App\Model\ArticleType;

class ArticleController extends Controller
{
    //文章列表
    public function index()
    {
        //获取数据
        $data = Article::all();
        //展示视图
        return view('admin.article.index',compact('data'));
    }

    //待审核文章列表
    public function review()
    {
        $data = Article::where('article_status','3')->get();
        return view('admin.article.index',compact('data'));
    }

    //审核不通过的文章列表
    public function notPassArticleList()
    {
        $data = Article::where('article_status','4') -> get();
        return view('admin.article.notPassList',compact('data'));
    }

    //查看文章详情
    public function page(Request $request)
    {
        //获取id
        $id = (int) $request -> get('id');
        $article = Article::find($id);
        return view('admin.article.page',compact('article'));
    }

    //文章添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //post添加检查
            $this -> validate($request,[
                'title' => 'required|unique:article,title',
                'author_id' => 'required|numeric',
                'article_content' => 'required',
                'type_id' => 'required|numeric',
                'read_num' => 'numeric',
                'favorites_num' => 'numeric',
                'article_sort' => 'numeric',
            ],[
                //翻译的提示信息
                'title.required' => '文章标题 不能为空', 
                'title.unique' => '文章标题 已存在', 
                'article_content.required' => '文章内容 不能为空',
                'read_num.numeric' => '阅读数 必须为数字',
                'favorites_num.numeric' => '收藏数 必须为数字',
                'article_sort.numeric' => '排序值 必须为数字',
            ]);
            //获取表单信息
            $data = $request -> only('title','author_id','article_content','type_id','read_num','favorites_num','article_sort');
            $data['status'] = 3; //文章状态
            $data['created_at'] = date('Y-m-d H:i:s'); //添加时间

            $request = Article::insert($data);//插入数据
            
            //判断是否成功
            if($request)
            {
                $response = ['code' => '0','msg' => '数据添加成功'];
            }
            else
            {
                $response = ['code' => '1','msg' => '数据添加失败'];
            }
            return response() -> json($response);
        }
        else
        {
            //get请求页面
            $articleType = ArticleType::all();
            return view('admin.article.add',compact('articleType'));
        }
        
    }

    //文章修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //post添加
            $id = $request -> get('id');
            $this -> validate($request,[
            'title' => [
                'required',
                Rule::unique('article')->ignore($id),
            ],
            'author_id' => 'required|numeric',
            'article_content' => 'required',
            'type_id' => 'required|numeric',
            'read_num' => 'numeric',
            'favorites_num' => 'numeric',
            'article_sort' => 'numeric',
        ],[
            //翻译的提示信息
            'title.required' => '文章标题 不能为空', 
            'title.unique' => '文章标题 已存在', 
            'article_content.required' => '文章内容 不能为空',
            'read_num.numeric' => '阅读数 必须为数字',
            'favorites_num.numeric' => '收藏数 必须为数字',
            'article_sort.numeric' => '排序值 必须为数字',
        ]);
            //获取表单信息
            $data = $request -> only('title','author_id','article_content','type_id','read_num','favorites_num','article_sort');
            $data['status'] = 3; //文章重新审核
            $data['updated_at'] = date('Y-m-d H:i:s'); //修改时间
            $request = Article::where('id',$id) -> update($data);//插入数据
            
            //判断是否成功
            if($request)
            {
                $response = ['code' => '0','msg' => '数据编辑成功'];
            }
            else
            {
                $response = ['code' => '1','msg' => '数据并未修改'];
            }
            return response() -> json($response);
        }
        else
        {
            //get请求页面
            $id = $request -> get('id');
            $data = Article::where('id',$id) -> get();
            $articleType = ArticleType::all();
            return view('admin.article.add',compact('data','articleType'));
        }
        
    }

    //文章启用
    public function start(Request $request)
    {
        $id = $request -> only('id');
        $data['article_status'] = 2;
        $data['reason'] = "";
        $request = Article::where('id',$id) -> update($data);

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
    //文章停用
    public function stop(Request $request)
    {
        $id = $request -> only('id');
        $data['article_status'] = 1;
        $request = Article::where('id',$id) -> update($data);

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

    //文章审核不通过
    public function notPass(Request $request)
    {
        $id = $request -> only('id');
        $data = $request -> only('reason');
        $data['article_status'] = 4;

        $request = Article::where('id',$id) -> update($data);

        //判断是否成功
        if($request)
        {
            $response = ['code' => '0','msg' => '审核完成'];
        }
        else
        {
            $response = ['code' => '1','msg' => '审核失败'];
        }
        return response() -> json($response);
    }

    //文章删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = Article::where('id',$id) -> delete();

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
