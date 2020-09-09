<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'キッチン'],
            ['category_name' => '生活日用品'],
            ['category_name' => 'インテリア雑貨'],
            ['category_name' => '食器'],
            ['category_name' => 'ファッション'],
            ['category_name' => 'かご・手工芸品'],
            ['category_name' => 'テーブル小物'],
            ['category_name' => '食品'],
            ['category_name' => '本'],
        ]);
    }
}
