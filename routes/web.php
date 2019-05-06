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

    //后台文件上传
    Route::post('uploader/webuploader','Admin\UploaderController@webuploader')->name('webuploader'); //后台上传头像
    //七牛云
    Route::post('uploader/qiniu','Admin\UploaderController@qiniu')->name('webuploader_qiniu'); //后台上传头像

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
        Route::get('page','Admin\ManagerController@page') -> name('admin_manager_page'); //管理员详情
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

    //会员管理
    Route::group(['prefix' => 'user'],function(){
        Route::get('index','Admin\UserController@index') -> name('admin_user_list'); //会员列表展示
        Route::get('page','Admin\UserController@page') -> name('admin_user_page'); //会员详情
        Route::any('add','Admin\UserController@add') -> name('admin_user_add');    //会员添加
        Route::any('edit','Admin\UserController@edit') -> name('admin_user_edit');  //会员编辑
        Route::post('start','Admin\UserController@start') -> name('admin_user_start');//会员启用
        Route::post('stop','Admin\UserController@stop') -> name('admin_user_stop');//会员停用
        Route::post('delete','Admin\UserController@delete') -> name('admin_user_delete'); //会员删除
        Route::get('export','Admin\UserController@export') -> name('admin_user_export'); //会员导出
        Route::get('getAreaById','Admin\UserController@getAreaById') -> name('admin_user_getAreaById'); //会员获取地区id
        Route::get('readyDeleteManager','Admin\UserController@readyDeleteManager') -> name('admin_user_readyDeleteManager'); //被删除的会员
        Route::post('foreverDeleteManager','Admin\UserController@foreverDeleteManager') -> name('admin_user_foreverDeleteManager'); //彻底删除被删除的会员
        Route::get('exportDeleteManager','Admin\UserController@exportDeleteManager') -> name('admin_user_exportDeleteManager'); //导出被删除的会员
    });

    //文章管理
    Route::group(['prefix' => 'article'],function(){
        Route::get('index','Admin\ArticleController@index') -> name('admin_article_list'); //文章列表展示
        Route::get('review','Admin\ArticleController@review') -> name('admin_article_review_list');//待审核文章列表
        Route::any('add','Admin\ArticleController@add') -> name('admin_article_add');    //文章添加
        Route::any('edit','Admin\ArticleController@edit') -> name('admin_article_edit');  //文章编辑
        Route::post('delete','Admin\ArticleController@delete') -> name('admin_article_delete'); //文章删除
        Route::post('start','Admin\ArticleController@start') -> name('admin_article_start');//文章启用
        Route::post('stop','Admin\ArticleController@stop') -> name('admin_article_stop');//文章停用
        Route::post('notPass','Admin\ArticleController@notPass') -> name('admin_article_notpass');//文章审核不通过
        Route::get('page','Admin\ArticleController@page') -> name('admin_article_page');//文章详情页
    });

    //文章类别
    Route::group(['prefix' => 'articleType'],function(){
        Route::get('index','Admin\ArticleTypeController@index') -> name('admin_articleType_list'); //文章类别列表展示
        Route::any('add','Admin\ArticleTypeController@add') -> name('admin_articleType_add');    //文章类别添加
        Route::any('edit','Admin\ArticleTypeController@edit') -> name('admin_articleType_edit');  //文章类别编辑
        Route::post('delete','Admin\ArticleTypeController@delete') -> name('admin_articleType_delete'); //文章类别删除
    });

    //评论管理
    Route::group(['prefix' => 'comment'],function(){
        Route::get('comment','Admin\CommentController@comment') -> name('admin_comment_page');//文章评论详情页
        Route::get('index','Admin\CommentController@index'); //评论列表展示
        Route::any('add','Admin\CommentController@add');    //评论添加
        Route::any('edit','Admin\CommentController@edit');  //评论编辑
        Route::post('delete','Admin\CommentController@delete');//评论删除
    });
});

