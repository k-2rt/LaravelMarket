<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('order_settings')->insert([
            [
                'shipping_fee' => '500',
                'shop_name' => NULL,
                'email' => NULL,
                'phone' => NULL,
                'address' => NULL,
                'logo' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
