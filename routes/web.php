<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//后台登录
Route::get('admin/login','Admin\PublicController@login') -> name('login');
//后台登录验证
Route::post('admin/login/check','Admin\publicController@check') -> name('admin_login_check');


//后台分组
Route::group(['prefix' => 'admin','middleware' => ['auth:admin','rbac']], function () {

    //后台首页
    Route::group(['prefix' => 'index'],function(){
        Route::get('','Admin\IndexController@index') -> name('admin_index'); //首页框架
        Route::get('welcome','Admin\IndexController@welcome') -> name('admin_welcome');//欢迎页
        Route::get('logout','Admin\IndexController@logout') -> name('admin_logout');//退出登录
    });

    //管理员管理
    Route::group(['prefix' => 'manager'],function(){
        Route::get('index','Admin\ManagerController@index') -> name('admin_manager_list'); //管理员列表展示
        Route::any('add','Admin\ManagerController@add') -> name('admin_manager_add');    //管理员添加
        Route::any('edit','Admin\ManagerController@edit') -> name('admin_manager_edit');  //管理员编辑
        Route::post('start','Admin\ManagerController@start') -> name('admin_manager_start');//管理员启用
        Route::post('stop','Admin\ManagerController@stop') -> name('admin_manager_stop');//管理员停用
        Route::post('delete','Admin\ManagerController@delete') -> name('admin_manager_delete');//管理员删除
        Route::any('editPassword','Admin\ManagerController@editPassword') -> name('admin_manager_editPassword');//管理员修改密码
    });

    //会员管理
    Route::group(['prefix' => 'user'],function(){
        Route::get('index','Admin\UserController@index') -> name('admin_user_list'); //会员列表展示
        Route::any('add','Admin\UserController@add') -> name('admin_user_add');    //会员添加
        Route::any('edit','Admin\UserController@edit') -> name('admin_user_edit');  //会员编辑
        Route::post('start','Admin\UserController@start') -> name('admin_user_start');//会员启用
        Route::post('stop','Admin\UserController@stop') -> name('admin_user_stop');//会员停用
        Route::post('delete','Admin\UserController@delete') -> name('admin_user_delete'); //会员删除
    });

    //文章管理
    Route::group(['prefix' => 'article'],function(){
        Route::get('index','Admin\ArticleController@index'); //文章列表展示
        Route::any('add','Admin\ArticleController@add');    //文章添加
        Route::any('edit','Admin\ArticleController@edit');  //文章编辑
        Route::post('delete','Admin\ArticleController@delete');//文章删除
    });

    //评论管理
    Route::group(['prefix' => 'comment'],function(){
        Route::get('index','Admin\CommentController@index'); //评论列表展示
        Route::any('add','Admin\CommentController@add');    //评论添加
        Route::any('edit','Admin\CommentController@edit');  //评论编辑
        Route::post('delete','Admin\CommentController@delete');//评论删除
    });

    //权限管理
    Route::group(['prefix' => 'auth'],function(){
        Route::get('index','Admin\AuthController@index') -> name('admin_auth_list'); //权限列表展示
        Route::any('add','Admin\AuthController@add') -> name('admin_auth_add');    //权限添加
        Route::any('edit','Admin\AuthController@edit') -> name('admin_auth_edit');  //权限编辑
        Route::post('delete','Admin\AuthController@delete') -> name('admin_auth_delete');//权限删除
    });

    //角色管理
    Route::group(['prefix' => 'role'],function(){
        Route::get('index','Admin\RoleController@index') -> name('admin_role_list'); //角色列表展示
        Route::any('add','Admin\RoleController@add') -> name('admin_role_add');    //角色添加
        Route::any('edit','Admin\RoleController@edit') -> name('admin_role_edit');  //角色编辑
        Route::any('editAuth','Admin\RoleController@editAuth') -> name('admin_role_edit_auth');  //角色权限编辑
        Route::post('delete','Admin\RoleController@delete') -> name('admin_role_delete');//角色删除
    });
});

