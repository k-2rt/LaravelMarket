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
            'kana' => 'カンリシャユーザー',
            'phone' => '09012345678',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'category' => "1",
            'coupon' => "1",
            'product' => "1",
            'article' => "1",
            'order' => "1",
            'other' => "1",
            'report' => "1",
            'return' => "1",
            'role' => "1",
            'contact' => "1",
            'comment' => "1",
            'setting' => "1",
            'type' => '1',
            'stock' => '1',
        ]);
    }
}
