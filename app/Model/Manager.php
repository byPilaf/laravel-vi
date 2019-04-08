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

    /**
     * 查询管理员对应角色
     */
    public function rel_role()
    {
        //一对一
        return $this -> hasOne('App\Model\Role','id','role_id');
    }
}
