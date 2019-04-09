<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //基本定义
    protected $table = 'auth';
    public $timestamps = false;
    
    /**
     * 查询父级权限
     */
    public function parentAuthName()
    {
        return $this -> hasOne('App\Model\Auth','id','pid');
    }

    /**
     * 查询子权限
     */
    public function childAuth()
    {
        return $this -> hasMany('App\Model\Auth','pid','id');
    }

}