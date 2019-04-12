<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //执行数据填充
        //生成faker实例
        $faker = \Faker\Factory::create('zh_CN');
        $data = [];
        for($i= 0;$i < 100; $i++)
        {
            $data[] = [
                'mobile'    =>     $faker -> phoneNumber,
                'membername'=>     $faker -> username,
                'password'  =>     bcrypt('123456'),
                'name'      =>     $faker -> name,
                'avatarUrl' =>     '/uploads/useravatar/avatar.png',
                'email'     =>     $faker -> email,
                'status'    =>     rand(1,2),
                'gender'    =>     rand(1,3),
                'type'      =>     rand(1,2),
                'created_at'=>     date('Y-m-d H:i:s'),
            ];
        }
        DB::table('user') -> insert($data);
    }
}
