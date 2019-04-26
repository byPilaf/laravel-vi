<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入Auth
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    //后台登录页面
    public function login()
    {
        return view('admin.login.index');
    }

    //登录检验
    public function check(Request $request)
    {
        //表单提交数据的认证
        $this -> validate($request,[
            'username'  =>  'required|min:3|max:20',
            'password'  =>  'required|min:6',
            'captcha'   =>  'required|captcha',
        ],[
            //没有翻译的提示信息
            'username.required' => '管理员账户 不能为空', 
            'username.min' => '管理员账户 长度小于3', 
            'username.max' => '管理员账户 长度大于20', 
            'captcha.captcha' => '验证码 错误',
            'captcha.required' => '验证码 不能为空',
        ]);

        //认证身份合法性
        $data = $request -> only(['username','password']); //截取提交的用户名与密码
        $data['manager_status'] = '2'; //默认状态正常登录
        // Auth认证
        if(Auth::guard('admin') -> attempt($data,$request -> get('online'))) //online是否保持登录状态
        {
            //认证通过
            return redirect(route('admin_index'));
        }
        else
        {
            //认证失败
            return redirect(route('login')) -> withErrors(['error' => '用户名或密码错误']);
        }
    }
}
