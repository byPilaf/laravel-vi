<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入模型
use App\Model\User;

class UserController extends Controller
{
    //会员列表
    public function index()
    {
        //获取数据
        $data = User::all();
        //展示视图
        return view('admin.user.index',compact('data'));
    }

    /**
     * 检查表单信息
     */
    private function checkPost($request)
    {
             //post添加检查
             $this -> validate($request,[
                'name' => 'max:20|unique:user,name',
                'mobile' => 'required|numeric|unique:user,mobile',
                'password' => 'required|min:6',
                'password2' => 'required|min:6|same:password',
                'email' => 'required|email',     
            ],[
                //翻译的提示信息
                'name.max' => '会员名称 长度大于20', 
                'name.unique' => '会员名称 已存在',
                'mobile.unique' => '会员手机号 已存在', 
                'password2.same' => '确认密码 错误',
                'password2.required' => '确认密码 不能为空',
                'password2.min' => '确认密码 长度小于6',
            ]);
    }

    //会员添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
           
            $this -> checkPost($request);
            //获取表单信息
            $data = $request -> only('name','password','email','mobile','uploadfile');
            $data['password'] = bcrypt($data['password']); //加密密码
            $data['created_at'] = date('Y-m-d H:i:s'); //添加时间

            $request = User::insert($data);//插入数据
            
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
            return view('admin.user.add');
        }
        
    }

    //会员修改
    public function edit(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //post添加
            $id = $request -> get('id');
            //获取表单信息
            $data = $request -> only('email','mobile','name','avatarUrl');
            $data['updated_at'] = date('Y-m-d H:i:s'); //修改时间
            $request = User::where('id',$id) -> update($data);//插入数据
            
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
            $data = User::where('id',$id) -> get();
            return view('admin.user.edit',compact('data'));
        }
        
    }

    //会员启用
    public function start(Request $request)
    {
        $id = $request -> only('id');
        $data['status'] = 2;
        $request = User::where('id',$id) -> update($data);

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
    //会员停用
    public function stop(Request $request)
    {
        $id = $request -> only('id');
        $data['status'] = 1;
        $request = User::where('id',$id) -> update($data);

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

    //会员删除
    public function delete(Request $request)
    {
        $id = $request -> only('id');
        $request = User::where('id',$id) -> delete();

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
