<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Thể thao 24h',
            'slug' => 'the-thao-24h',
            'desc' => 'Cập nhật thông tin thể thao 24/7',
            'parent' => 0,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Bóng đá',
            'slug' => 'bong-da',
            'parent' => 0,
            'desc' => 'Cập nhật thông tin bóng đá',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
