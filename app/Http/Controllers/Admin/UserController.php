<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//引入模型
use App\Model\User;
//数据验证
use Illuminate\Validation\Rule;
//引入Excel
use Excel;

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

    //查看会员详情
    public function page(Request $request)
    {
        //获取id
        $id = (int) $request -> get('id');
        $user = User::find($id);
        //获取地址
        $area['country'] = DB::table('area') -> where('id',$user['country_id']) -> value('area');
        $area['province'] = DB::table('area') -> where('id',$user['province_id']) -> value('area');
        $area['city'] = DB::table('area') -> where('id',$user['city_id']) -> value('area');
        $area['county'] = DB::table('area') -> where('id',$user['county_id']) -> value('area');

        return view('admin.user.page',compact('user','area'));
    }

    //会员导出Excel
    public function export() 
    {
        //查询用户表
        $data = User::select('id','mobile','membername','email','gender','name')->get();
        $cellDate[] = ['id','手机','账户名','电子邮件','性别','昵称'];

        //循环
        foreach($data as $value)
        {   
            $cellDate[] = [
                $value -> id,
                $value -> mobile,
                $value -> membername,
                $value -> email,
                $value -> gender,
                $value -> name,
            ];
        }

        //调用 Excel类创建一个 Excel文件
        Excel::create('用户导出',function($excel) use ($cellDate){
            //创建一个工资表
            $excel -> sheet('用户',function($sheet) use ($cellDate){
                //将数据写入到行内
                $sheet -> rows($cellDate);
            });
        }) -> export('xls'); //导出文件
    }

    //根据地区id获取下属行政区划
    public function getAreaById(Request $request)
    {
        //获取id
        $id = (int) $request -> get('id');
        //获取下属地址
        $data = DB::table('area') -> where('pid',$id) -> get();
        //输出json数据
        return response() -> json($data);
    }

    //会员添加
    public function add(Request $request)
    {
        if($request -> isMethod('post'))
        {
            //检查表单信息
            $this -> validate($request,[
                'name' => 'max:20|unique:user,name',
                'mobile' => 'required|numeric|unique:user,mobile',
                'membername' => 'required|numeric|unique:user,membername',
                'password' => 'required|min:6',
                'password2' => 'required|min:6|same:password',
                'email' => 'required|email|unique:user,membername',     
            ],[
                //翻译的提示信息
                'name.max' => '会员名称 长度大于20', 
                'name.unique' => '会员名称 已存在',
                'mobile.unique' => '会员手机号 已存在', 
                'password2.same' => '确认密码 错误',
                'password2.required' => '确认密码 不能为空',
                'password2.min' => '确认密码 长度小于6',
            ]);
            //获取表单信息
            $data = $request -> only('mobile','membername','password','name','email','country_id','province_id','city_id','county_id','gender','type','avatarUrl');
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
            //查询国家数据
            $country = DB::table('area') -> where('pid','0') -> get();
            //get请求页面
            return view('admin.user.add',compact('country'));
        }
    }

    //会员修改
    public function edit(Request $request)
    {
        $id = $request -> get('id');
        if($request -> isMethod('post'))
        {
            //post添加
            //检查表单信息
            $this -> validate($request,[
                'name' => [
                    'max:20',
                    Rule::unique('user')->ignore($id),
                ],
                'mobile' => [
                    'required',
                    'numeric',
                    Rule::unique('user')->ignore($id),
                ],
                'membername' => [
                    'required',
                    'max:20',
                    Rule::unique('user')->ignore($id),
                ],
                'email' =>[
                    'required',
                    'email',
                    Rule::unique('user')->ignore($id),
                ],     
            ]);

            //获取表单信息
            $data = $request -> only('mobile','membername','name','email','country_id','province_id','city_id','county_id','gender','type','avatarUrl');
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
            $data = User::find($id);
            //查询国家数据
            $country = DB::table('area') -> where('pid','0') -> get();
            $province = DB::table('area') -> where('pid',$data['country_id']) -> get();
            $city = DB::table('area') -> where('pid',$data['province_id']) -> get();
            $county = DB::table('area') -> where('pid',$data['city_id']) -> get();
            
            return view('admin.user.edit',compact('data','country','province','city','county'));
        }
        
    }

    //会员启用
    public function start(Request $request)
    {
        $id = $request -> only('id');
        $data['user_status'] = 2;
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
        $data['user_status'] = 1;
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

    //查询被删除的会员
    public function readyDeleteManager()
    {
        $data = User::onlyTrashed() -> get();
        //展示视图
        return view('admin.user.readyDelete',compact('data'));
    }

    //彻底删除被删除的会员
    public function foreverDeleteManager(Request $request)
    {
        $id = $request -> only('id');
        $request = User::where('id',$id) -> forceDelete();
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

    //导出被删除的会员Excel
    public function exportDeleteManager() 
    {
        //查询用户表
        $data = User::onlyTrashed() -> select('id','mobile','membername','email','gender','name')->get();
        $cellDate[] = ['id','手机','账户名','电子邮件','性别','昵称'];

        //循环
        foreach($data as $value)
        {   
            $cellDate[] = [
                $value -> id,
                $value -> mobile,
                $value -> membername,
                $value -> email,
                $value -> gender,
                $value -> name,
            ];
        }

        //调用 Excel类创建一个 Excel文件
        Excel::create('被删除的用户导出',function($excel) use ($cellDate){
            //创建一个工资表
            $excel -> sheet('被删除的用户',function($sheet) use ($cellDate){
                //将数据写入到行内
                $sheet -> rows($cellDate);
            });
        }) -> export('xls'); //导出文件
    }
}
