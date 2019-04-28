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
}
