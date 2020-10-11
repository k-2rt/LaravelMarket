<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SiteSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('site_setting')->insert([
            [
                'phone_one' => '09012345678',
                'phone_two' => '08012341234',
                'email' => 'nippon.kurashi@gmail.com',
                'company_name' => 'クラシテル',
                'company_address' => '東京都港区芝公園４丁目２−８',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
