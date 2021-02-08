<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('roles')->insert([
            'name' => 'Executive One',
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('roles')->insert([
            'name' => 'Executive Two',
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('roles')->insert([
            'name' => 'Executive Three',
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('roles')->insert([
            'name' => 'Executive Four',
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'pro_img' => 'default.png',
            'password' => bcrypt('123456'),
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Executive One',
            'email' => 'executive1@gmail.com',
            'pro_img' => 'default.png',
            'password' => bcrypt('123456'),
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Executive Two',
            'email' => 'executive2@gmail.com',
            'pro_img' => 'default.png',
            'password' => bcrypt('123456'),
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('users')->insert([
            'role_id' => '4',
            'name' => 'Executive Three',
            'email' => 'executive3@gmail.com',
            'pro_img' => 'default.png',
            'password' => bcrypt('123456'),
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);
        DB::table('users')->insert([
            'role_id' => '5',
            'name' => 'Executive Four',
            'email' => 'executive4@gmail.com',
            'pro_img' => 'default.png',
            'password' => bcrypt('123456'),
            'created_at' => '2019-09-05 11:13:00',
            'updated_at' => '2019-09-05 11:13:00',
        ]);

    }
}
