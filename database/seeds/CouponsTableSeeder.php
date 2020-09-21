<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('coupons')->insert([
            [
                'coupon' => '春のパン祭り',
                'discount' => '500',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'coupon' => '学割キャンペーン',
                'discount' => '500',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'coupon' => '新生活キャンペーン',
                'discount' => '1000',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
