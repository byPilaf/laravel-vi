<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//软删除
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    //软删除trait
    use SoftDeletes;
    //基本定义
    protected $table = 'user';
    protected $dates = ['deleted_at'];
    
}
