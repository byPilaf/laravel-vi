<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //基本定义
    protected $table = 'role';
    public $timestamps = false;

    public function manager_name()
    {
        return $this -> hasMany('App\Model\Manager','role_id','id');
    }
}
