<?php

use Illuminate\Database\Seeder;

class ArticleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //执行数据填充
        $data = [
            [
                'typename' => '新闻',
            ],
            [
                'typename' => '技术',
            ],
            [
                'typename' => '转发',
            ],
        ];
        DB::table('article_type')->insert($data);
    }
}
