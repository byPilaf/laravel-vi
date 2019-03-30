<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //基本定义
    protected $table = 'role';
    public $timestamps = false;

    /**
     * 获得此角色的权限
     */
    public function auths()
    {
        return $this->belongsToMany('App\Model\Auth','role_auth','role_id','auth_id');
    }
    
}
