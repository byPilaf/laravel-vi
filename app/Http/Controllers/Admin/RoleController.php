<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\Role;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        //获取数据
        $data = Role::all();
        //展示视图
        return view('admin.role.index',compact('data'));
    }

    //角色添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {           
            $this -> checkPost($request);
            //获取表单信息
            $data = $request -> only('rolename');
            $request = Role::insert($data);//插入数据
            
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
            return view('admin.role.add');
        }
        
    }

    //角色修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //post添加
            $id = $request -> get('id');
            //获取表单信息
            $data = $request -> only('rolename');
            $request = Role::where('id',$id) -> update($data);//插入数据
            
            //判断是否成功
            if($request)
            {
                $response = ['code' => '0','msg' => '数据编辑成功'];
            }
            else
            {
                $response = ['code' => '1','msg' => '数据编辑失败'];
            }
            return response() -> json($response);
        }
        else
        {
            //get请求页面
            $id = $request -> get('id');
            $data = Role::where('id',$id) -> get();
            return view('admin.role.edit',compact('data'));
        }
        
    }
}
