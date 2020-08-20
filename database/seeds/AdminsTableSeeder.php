<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => '管理者ユーザー',
            'phone' => '09012345678',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
