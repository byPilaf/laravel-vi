<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\Auth;

class AuthController extends Controller
{
    //权限列表展示
    public function index()
    {
        $data = Auth::all();
        return view('admin.auth.index',compact('data'));
    }

    /**
     * 检查表单信息
     */
    private function checkPost($request)
    {
        //检查表单信息
        $this -> validate($request,[
            'authname' => 'required|unique:auth,authname',
            'controller' => 'required',
            'pid' => 'required|numeric',
            'is_nav' => 'required',
        ],[
            'authname.required' => '权限名称不能为空',
            'authname.unique' => '权限名称已存在', 
            'controller.required' => '控制器名不能为空',
            'pid.required' => '请选择父级权限',
            'pid.numeric' => '输入不合法',
            'is_nav' => '请选择是否作为列表显示',
        ]);
    }

    //权限添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //检查表单信息
            $this -> validate($request,[
                'authname' => 'required|unique:auth,authname',
                'controller' => 'required',
                'pid' => 'required|numeric',
                'is_nav' => 'required',
            ],[
                'authname.required' => '权限名称不能为空',
                'authname.unique' => '权限名称已存在', 
                'controller.required' => '控制器名不能为空',
                'pid.required' => '请选择父级权限',
                'pid.numeric' => '输入不合法',
                'is_nav' => '请选择是否作为列表显示',
            ]);
            //获取表单信息
            $data = $request -> only('authname','controller','action','pid','is_nav');
            //添加数据
            $reques = Auth::insert($data);

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
            //获取顶级权限
            $parents = Auth::where('pid',0) -> get(); 
            return view('admin.auth.add',compact('parents'));
        }
    }

    //权限修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            $id = $request -> get('id');
            //检查表单信息
            $this -> validate($request,[
                'authname' => 'required',
                'controller' => 'required',
                'pid' => 'required|numeric',
                'is_nav' => 'required',
            ],[
                'authname.required' => '权限名称不能为空',
                'controller.required' => '控制器名不能为空',
                'pid.required' => '请选择父级权限',
                'pid.numeric' => '输入不合法',
                'is_nav' => '请选择是否作为列表显示',
            ]);
            //获取表单信息
            $data = $request -> only('authname','controller','action','pid','is_nav');
            //添加数据
            $request = Auth::where('id',$id) -> update($data);

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
            $id  = $request -> get('id');
            $data = Auth::where('id',$id) -> get();
            //获取顶级权限
            $parents = Auth::where('pid',0) -> get();
            return view('admin.auth.edit',compact('data','parents'));
        }
    }

    //权限删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = Auth::where('id',$id) -> delete();

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
