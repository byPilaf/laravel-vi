<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //基本定义
    protected $table = 'manager';

    //使用trait
    use Authenticatable;

    //关联角色模型
    public function rel_role()
    {
        //一对一
        return $this -> hasOne('App\Model\Role','id','role_id');
    }
}
