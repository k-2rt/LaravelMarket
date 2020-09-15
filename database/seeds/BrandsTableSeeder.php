<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'brand_name' => '野田琺瑯',
            ],
            [
                'brand_name' => '和平フレイズ',
            ],
            [
                'brand_name' => 'バーミキュラ',
            ],
            [
                'brand_name' => 'カリタ',
            ],
            [
                'brand_name' => 'HARIO',
            ],

            [
                'brand_name' => 'GLOBAL',
            ],
            [
                'brand_name' => '藤次郎',
            ],

            [
                'brand_name' => '今治タオル',
            ],
            [
                'brand_name' => '泉州タオル',
            ],
            [
                'brand_name' => 'おぼろタオル',
            ],

            [
                'brand_name' => 'スノーピーク',
            ],
            [
                'brand_name' => 'ユニフレーム',
            ],
            [
                'brand_name' => 'モンベル',
            ],

            [
                'brand_name' => 'ノリタケ',
            ],
            [
                'brand_name' => 'たち吉',
            ],
            [
                'brand_name' => '土屋鞄',
            ],

        ]);
    }
}
