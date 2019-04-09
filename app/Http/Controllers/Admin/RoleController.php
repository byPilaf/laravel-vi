<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\Role;
use App\Model\Auth;
use App\Model\Role_Auth;

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

    /**
     * 检查表单信息
     */
    private function checkPost($request)
    {
        //检查post添加
        $this -> validate($request,[
            'rolename' => 'required|unique:role,rolename',
        ],[
            //翻译信息
            'rolename.required' => '角色名不能为空',
            'rolename.unique' => '角色名已存在', 
        ]);
    }

    /**
     * 角色id与权限id相对应合成数组
     */
    private function addRoleIdAuthId($role_id,$auth_id)
    {
        $role_auth = [];
        foreach ($auth_id['auth_id'] as $value) 
        {
            $array = [
                'role_id' => $role_id,
                'auth_id' => $value,
            ];
            array_push($role_auth,$array);
        }
        return $role_auth;
    }

    //角色添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {           
            $this -> checkPost($request);
            //获取表单信息
            $data = $request -> only('rolename','description');
            //获取auth_id
            $auth_id = $request -> only('auth_id');
            //插入数据并获取插入数据的角色id
            $role_id = Role::insertGetId($data);
            if($role_id)
            {
                //若成功插入角色数据,并返回新的角色id
                $role_auth = $this -> addRoleIdAuthId($role_id,$auth_id);
                //插入role_auth表
                $request = Role_Auth::insert($role_auth);
            }
            else
            {
                $request = false;
            }
            
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
            //获取权限
            $topAuth = Auth::where('pid',0) -> get();
            //get请求页面
            return view('admin.role.add',compact('topAuth'));
        }
        
    }

    //角色修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            $role_id = $request -> get('id');
            // $this -> checkPost($request);
            //获取表单信息
            $data = $request -> only('rolename','description');
            //获取auth_id
            $auth_id = $request -> only('auth_id');
            //插入数据并获取插入数据的角色id
            $request = Role::where('id',$role_id) -> update($data);

            $request2 = Role_Auth::where('role_id',$role_id) -> delete();
            //若成功插入角色数据,并返回新的角色id
            $role_auth = $this -> addRoleIdAuthId($role_id,$auth_id);
            //插入role_auth表
            $request2 = Role_Auth::insert($role_auth);
            
            //判断是否成功
            if($request2)
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
            $id = $request -> get('id');
            //获取角色
            $data = Role::find($id);
            //获取权限
            $topAuth = Auth::where('pid',0) -> get();
            return view('admin.role.edit',compact('data','topAuth'));
        }
        
    }

    //角色删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = Role::where('id',$id) -> delete();
        if($request)
        {
            $request2 = Role_Auth::where('role_id',$id) -> delete();
        }
        else
        {
            $request2 = false;
        }
        //判断是否成功
        if($request && $request2)
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
