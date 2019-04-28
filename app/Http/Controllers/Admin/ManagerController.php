<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\Manager;
use App\Model\Role;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    //管理员列表
    public function index()
    {
        //获取数据
        $data = Manager::all();
        //展示视图
        return view('admin.manager.index',compact('data'));
    }

    //查看管理员详情
    public function page(Request $request)
    {
        //获取id
        $id = (int) $request -> get('id');
        $manager = Manager::find($id);
        return view('admin.manager.page',compact('manager'));
    }

    //管理员添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
           
            //post添加检查
            $this -> validate($request,[
                'username' => 'required|min:3|max:20|unique:manager,username',
                'password' => 'required|min:6',
                'password2' => 'required|min:6|same:password',
                'gender' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email',     
                'role_id' => 'required',
            ],[
                //翻译的提示信息
                'username.required' => '管理员账户 不能为空', 
                'username.min' => '管理员账户 长度小于3', 
                'username.max' => '管理员账户 长度大于20', 
                'username.unique' => '管理员账户 已存在', 
                'password2.same' => '确认密码 错误',
                'password2.required' => '确认密码 不能为空',
                'password2.min' => '确认密码 长度小于6',
                'role_id.required' => '角色 不能为空'
            ]);
            //获取表单信息
            $data = $request -> only('username','password','email','mobile','gender','role_id');
            $data['password'] = bcrypt($data['password']); //加密密码
            $data['created_at'] = date('Y-m-d H:i:s'); //添加时间

            $request = Manager::insert($data);//插入数据
            
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
            $role = Role::all();
            return view('admin.manager.add',compact('role'));
        }
        
    }

    //管理员修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //post添加
            $id = $request -> get('id');
            //post编辑检查
            $this -> validate($request,[
                'gender' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'required|email',     
                'role_id' => 'required',
            ],[
                //翻译的提示信息
                'role_id.required' => '角色 不能为空'
            ]);
            //获取表单信息
            $data = $request -> only('email','mobile','gender','role_id');
            $data['updated_at'] = date('Y-m-d H:i:s'); //修改时间
            $request = Manager::where('id',$id) -> update($data);//插入数据
            
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
            $data = Manager::where('id',$id) -> get();
            $role = Role::all();
            return view('admin.manager.edit',compact('data','role'));
        }
        
    }

    //管理员启用
    public function start(Request $request)
    {
        $id = $request -> only('id');
        $data['manager_status'] = 2;
        $request = Manager::where('id',$id) -> update($data);

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
    //管理员停用
    public function stop(Request $request)
    {
        $id = $request -> only('id');
        $data['manager_status'] = 1;
        $request = Manager::where('id',$id) -> update($data);

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

    //管理员删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = Manager::where('id',$id) -> delete();

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

    //管理员修改密码
    public function editPassword(Request $request)
    {
        $id = $request -> only('id');
        if($request -> isMethod('post'))
        {   
            $this -> validate($request,[
                'oldpassword' => 'required|min:6',
                'newpassword' => 'required|min:6',
                'newpassword2' => 'required|min:6|same:newpassword',
                'captcha'   =>  'required|captcha',
            ],[
                'captcha.captcha' => '验证码错误',
            ]);
            $password = $request -> only('oldpassword','newpassword');
            $oldPassword = Manager::where('id',$id) -> value('password');
            if(Hash::check($password['oldpassword'], $oldPassword))
            {
                $data['password'] = bcrypt($password['newpassword']);
                $request = Manager::where('id',$id) -> update($data);
            }
            else
            {   
                $request = false;
            }

            if($request)
            {
                $response = ['code' => '0','msg' => '密码修改成功'];
            }
            else
            {
                $response = ['code' => '1','msg' => '原密码错误,修改失败'];
            }
            return response() -> json($response);
        }
        else
        {
            $data = Manager::where('id',$id) -> value('username');
            return view('admin.manager.editPassword',compact('data'));
        }
    }
}
