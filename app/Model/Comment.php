<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //基本定义
    protected $table = 'comment';

    /**
     * 获得此评论所属的文章。
     */
    public function post_article()
    {
        return $this->belongsTo('App\Model\Article', 'article_id');
    }

    /**
     * 查看评论作者
     */
    public function post_user()
    {
        return $this -> hasOne('App\Model\User','id','user_id');
    }
}
