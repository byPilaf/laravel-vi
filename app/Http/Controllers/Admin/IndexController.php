<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{
    //后台框架
    public function index()
    {
        return view('admin.index.index');
    }

    //后台欢迎页
    public function welcome()
    {
        return view('admin.index.welcome');
    }

    //退出登录
    public function logout()
    {
        //清除session
        Auth::guard('admin') -> logout();
        //跳转
        return redirect(route('login'));
    }
}
