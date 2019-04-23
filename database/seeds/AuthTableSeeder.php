<?php

use Illuminate\Database\Seeder;

class AuthTableSeeder extends Seeder
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
                'authname' => '后台首页',
                'controller' => NULL,
                'action' => NULL,
                'pid' => 0,
                'is_nav' => '2'
            ],
            [
                'authname' => '后台首页框架',
                'controller' => 'IndexController',
                'action' => 'index',
                'pid' => 1,
                'is_nav' => '2'
            ],
            [
                'authname' => '后台首页面板',
                'controller' => 'IndexController',
                'action' => 'welcome',
                'pid' => 1,
                'is_nav' => '1'
            ],
            [
                'authname' => '管理员管理',
                'controller' => NULL,
                'action' => NULL,
                'pid' => 0,
                'is_nav' => '2'
            ],
            [
                'authname' => '管理员列表',
                'controller' => 'ManagerController',
                'action' => 'index',
                'pid' => 4,
                'is_nav' => '1'
            ],
            [
                'authname' => '管理员添加',
                'controller' => 'ManagerController',
                'action' => 'add',
                'pid' => 4,
                'is_nav' => '2'
            ],
            [
                'authname' => '管理员修改',
                'controller' => 'ManagerController',
                'action' => 'edit',
                'pid' => 4,
                'is_nav' => '2'
            ],
            [
                'authname' => '管理员删除',
                'controller' => 'ManagerController',
                'action' => 'delete',
                'pid' => 4,
                'is_nav' => '2'
            ],
            [
                'authname' => '管理员停用',
                'controller' => 'ManagerController',
                'action' => 'stop',
                'pid' => 4,
                'is_nav' => '2'
            ],
            [
                'authname' => '管理员启用',
                'controller' => 'ManagerController',
                'action' => 'start',
                'pid' => 4,
                'is_nav' => '2'
            ],
        ];
        DB::table('auth')->insert($data);
    }
}
