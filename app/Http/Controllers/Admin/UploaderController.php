<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class UploaderController extends Controller
{
    //文件保存方法
    public function webuploader(Request $request)
    {
        //开始文件上传
        if($request -> file('file') -> isValid() && $request -> hasFile('file'))
        {
            //上传处理
            //对文件进行重命名
            $fileName = sha1(time() . rand(100000,999999)) . "." . $request -> file('file') -> getClientOriginalExtension();
            //获取文件并存储,重命名
            $result = Storage::disk('public') -> put($fileName,file_get_contents($request -> file('file') -> path()));
            //返回信息
            if($result)
            {
                //成功
                $response = ['code' => '0','msg' => '上传成功','filepath' => '/storage/' . $fileName];
            }
            else
            {   
                //失败
                $response = ['code' => '1','msg' => $request -> file('file') -> getErrorMessage()];
            }
        }   
        else
        {
            $response = ['code' => 2,'msg' => '非法上传文件'];
        }

        //输入结果
        return response() -> json($response);
    }

}
