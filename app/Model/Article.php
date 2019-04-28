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

    /**
     * 查询文章对应作者
     */
    public function rel_author()
    {
        //一对一
        return $this -> hasOne('App\Model\User','id','author_id');
    }

    /**
     * 查询文章对应评论
     */
    public function rel_comment()
    {
        return $this -> hasMany('App\Model\Comment','article_id');
    }
}
