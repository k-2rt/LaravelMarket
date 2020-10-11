<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            CategoriesTableSeeder::class,
            SubCategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ProductsTableSeeder::class,
            CouponsTableSeeder::class,
            OrderSettingsTableSeeder::class,
            PostCategoriesTableSeeder::class,
            PostsTableSeeder::class,
            SiteSettingTableSeeder::class,
        ]);
    }
}
