<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin') -> user() -> role_id != '1')
        {
            //若不是超级管理员
            //获取当前访问的路由并截取具体的部分
            $rourte = explode('\\',Route::currentRouteAction());
            //获取当前用户对应的角色的权限
            $role = Auth::guard('admin') -> user() -> rel_role -> auths;
            //合成权限控制器与方法的字符串
            $auths = '';
            foreach ($role as $value) 
            {
                $auths .= $value['controller'] . '@' . $value['action'].',';
            }
            //比较权限是否存在
            if(stripos($auths,end($rourte)) === false )
            {
                //若不存在权限
                exit('您没有权限访问');
            }
            else
            {
                return $next($request);
            }
        }
        else
        {
            //超级管理员
            return $next($request);
        }
    }
}
