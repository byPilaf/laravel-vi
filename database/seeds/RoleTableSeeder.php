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
                'rolename' => '超级管理员'
            ],
            [
                'rolename' => '总裁办'
            ],
            [
                'rolename' => '总编辑'
            ],
            [
                'rolename' => '人事部'
            ],
            [
                'rolename' => '主编'
            ],
            [
                'rolename' => '编辑'
            ],
        ];
        DB::table('role')->insert($data);
    }
}
