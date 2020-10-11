<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '山田太郎',
            'kana' => 'ヤマダタロウ',
            'phone' => '09012345678',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test1234'),
            'zip_code' => '1000000',
            'prefectures' => '13',
            'address1' => '品川駅1-1-1',
            'address2' => '東京タワー',
            'provider' => '東京タワー',
            'address2' => '東京タワー',
        ]);
    }
}
