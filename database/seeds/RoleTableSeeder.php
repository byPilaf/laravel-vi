<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
                'rolename' => '超级管理员',
                'description' => '至高无上',
            ],
            [
                'rolename' => '总裁办',
                'description' => '权限管理以及其他'
            ],
            [
                'rolename' => '总编辑',
                'rolename' => '文章管理以及其他'
            ],
            [
                'rolename' => '人事部',
                'description' => '人员管理以及其他',
            ],
            [
                'rolename' => '主编',
                'description' => '文章的编辑工作'
            ],
            [
                'rolename' => '编辑',
                'description' => '部分文章的修改权限'
            ],
        ];
        DB::table('role')->insert($data);
    }
}
