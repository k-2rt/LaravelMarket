<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('posts')->insert([
            [
                'post_category_id' => 1,
                'post_title_en' => 'Test',
                'post_title_ja' => 'テスト',
                'post_image' => NULL,
                'details_en' => 'Test Test',
                'details_ja' => 'テスト テスト',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
