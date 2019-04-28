<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    //基本定义
    protected $table = 'article_type';
    public $timestamps = false;

    /**
     * 查询父级类别
     */
    public function parentType()
    {
        return $this -> hasOne('App\Model\ArticleType','id','pid');
    }

}
