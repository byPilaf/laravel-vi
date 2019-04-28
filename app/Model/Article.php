<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //基本定义
    protected $table = 'article';

    /**
     * 查询文章对应文章类型
     */
    public function rel_type()
    {
        //一对一
        return $this -> hasOne('App\Model\ArticleType','id','type_id');
    }
}
