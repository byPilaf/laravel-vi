<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //基本定义
    protected $table = 'role';
    public $timestamps = false;

    /**
     * 查询角色下对应的管理员
     */
    public function manager_name()
    {
        return $this -> hasMany('App\Model\Manager','role_id','id');
    }

    /**
     * 查询角色下对应权限
     */
    public function auths()
    {
        return $this -> belongsToMany('App\Model\Auth','role_auth','role_id','auth_id');
    }
}
