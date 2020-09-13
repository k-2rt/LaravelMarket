<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'ペティーナイフ',
                'product_code' => '001',
                'product_quantity' => '3',
                'selling_price' => '7700',
                'discount_price' => NULL,
                'category_id' => '1',
                'subcategory_id' => '3',
                'brand_id' => '6',
                'product_size' => '13cm',
                'product_color' => 'シルバー',
                'product_details' => '小型なので野菜や果物などの細工・飾り切りに適しています。 特に切っ先付近の鋭いカーブを活かして「引き切り」に重宝します。',
                'video_link' => 'https://www.youtube.com/watch?v=wLK-tsCGwSI',
                'status' => '1',
                'hot_new' => '1',
                'trend' => '1',
                'best_rated' => '1',
                'hot_deal' => '1',
                'main_slider' => '1',
                'mid_slider' => '1',
                'buyone_getone' => '1',
            ],
            [
                'product_name' => 'V60レンジサーバー',
                'product_code' => '002',
                'product_quantity' => '5',
                'selling_price' => '3000',
                'discount_price' => '2700',
                'category_id' => '1',
                'subcategory_id' => '2',
                'brand_id' => '5',
                'product_size' => '1-3杯用, 2-5杯用, 2-6杯用',
                'product_color' => '透明ブラック',
                'product_details' => 'ポット・フタとともに耐熱ガラス製。フタにはシリコンパッキン付きの安心設計です。フタをしたまま電子レンジOK。',
                'video_link' => NULL,
                'status' => '1',
                'hot_new' => '1',
                'trend' => '1',
                'best_rated' => '1',
                'hot_deal' => NULL,
                'main_slider' => '1',
                'mid_slider' => NULL,
                'buyone_getone' => '1',
            ],
            [
                'product_name' => 'オーブンポットラウンド',
                'product_code' => '003',
                'product_quantity' => '10',
                'selling_price' => '29990',
                'discount_price' => '25000',
                'category_id' => '1',
                'subcategory_id' => '1',
                'brand_id' => '3',
                'product_size' => '18cm, 20cm, 22cm',
                'product_color' => 'ナチュラルベージュ, ストーン, マットブラック',
                'product_details' => '直火・IHクッキングヒーター対応のバーミキュラがイチオシするホーローコーティングの鍋。',
                'video_link' => NULL,
                'status' => '1',
                'hot_new' => '1',
                'trend' => '1',
                'best_rated' => '1',
                'hot_deal' => '1',
                'main_slider' => '1',
                'mid_slider' => '1',
                'buyone_getone' => '1',
            ],
        ]);
    }
}
