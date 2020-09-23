<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('post_categories')->insert([
            [
                'category_name_en' => 'Kitchen',
                'category_name_ja' => 'キッチン',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name_en' => 'Daily necessities',
                'category_name_ja' => '生活日用品',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
