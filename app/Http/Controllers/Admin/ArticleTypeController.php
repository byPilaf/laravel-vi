<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Model\ArticleType;
//数据验证
use Illuminate\Validation\Rule;
class ArticleTypeController extends Controller
{
    //文章类别列表展示
    public function index()
    {
        $data = ArticleType::all();
        return view('admin.articleType.index',compact('data'));
    }

    //文章类别添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //检查表单信息
            $this -> validate($request,[
                'typename' => 'required|unique:article_type,typename',
            ],[
                'typename.required' => '文章类别名称不能为空',
                'typename.unique' => '文章类别名称已存在', 
            ]);
            //获取表单信息
            $data = $request -> only('typename','pid','display');
            //添加数据
            $reques = ArticleType::insert($data);

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
            //获取类别
            $parents = ArticleType::all();
            return view('admin.articleType.add',compact('parents'));
        }
    }

    //文章类别修改
    public function edit(Request $request)
    {
        $id = $request -> get('id');
        if($request -> isMethod('post'))
        {
            //检查表单信息
            $this -> validate($request,[
                'typename' => [
                    'required',
                    Rule::unique('article_type')->ignore($id),
                ],
            ],[
                'typename.required' => '文章类别名称不能为空',
            ]);
            //获取表单信息
            $data = $request -> only('typename','pid','display');
            //添加数据
            $request = ArticleType::where('id',$id) -> update($data);

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
            //获取其他类别
            $parents = ArticleType::where('id','<>',$id) -> get();
            $data = ArticleType::find($id);
            return view('admin.articleType.edit',compact('data','parents'));
        }
    }

    //文章类别删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = ArticleType::where('id',$id) -> delete();

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
