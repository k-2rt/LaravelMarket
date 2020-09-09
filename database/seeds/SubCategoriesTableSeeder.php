<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            [
                'category_id' => '1',
                'subcategory_name' => 'お鍋',
            ],
            [
                'category_id' => '1',
                'subcategory_name' => '珈琲道具',
            ],
            [
                'category_id' => '1',
                'subcategory_name' => '包丁',
            ],

            [
                'category_id' => '2',
                'subcategory_name' => '掃除道具',
            ],
            [
                'category_id' => '2',
                'subcategory_name' => 'タオル',
            ],
            [
                'category_id' => '2',
                'subcategory_name' => 'アウトドア',
            ],

            [
                'category_id' => '3',
                'subcategory_name' => 'オブジェ',
            ],
            [
                'category_id' => '3',
                'subcategory_name' => '照明',
            ],
            [
                'category_id' => '3',
                'subcategory_name' => '時計',
            ],

            [
                'category_id' => '4',
                'subcategory_name' => 'お皿',
            ],
            [
                'category_id' => '4',
                'subcategory_name' => 'お椀',
            ],
            [
                'category_id' => '4',
                'subcategory_name' => '急須',
            ],

            [
                'category_id' => '5',
                'subcategory_name' => '財布',
            ],
            [
                'category_id' => '5',
                'subcategory_name' => '靴',
            ],
            [
                'category_id' => '5',
                'subcategory_name' => '着物',
            ],

            [
                'category_id' => '6',
                'subcategory_name' => 'かご',
            ],
            [
                'category_id' => '6',
                'subcategory_name' => '鍋しき',
            ],

            [
                'category_id' => '7',
                'subcategory_name' => '箸',
            ],
            [
                'category_id' => '7',
                'subcategory_name' => '箸置き',
            ],

            [
                'category_id' => '8',
                'subcategory_name' => 'お茶',
            ],
            [
                'category_id' => '8',
                'subcategory_name' => 'お米',
            ],
            [
                'category_id' => '8',
                'subcategory_name' => 'お魚',
            ],

            [
                'category_id' => '9',
                'subcategory_name' => '書籍',
            ],

        ]);
    }
}
