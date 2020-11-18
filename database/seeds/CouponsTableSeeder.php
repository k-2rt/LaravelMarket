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
                'coupon_name' => '春のパン祭り',
                'coupon_cd' => 'panfes',
                'discount' => '500',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'coupon_name' => '学割キャンペーン',
                'coupon_cd' => 'stud',
                'discount' => '500',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'coupon_name' => '新生活キャンペーン',
                'coupon_cd' => 'newlife',
                'discount' => '1000',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'coupon_name' => '初回定期購読キャンペーン',
                'coupon_cd' => 'subsc',
                'discount' => '1000',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
