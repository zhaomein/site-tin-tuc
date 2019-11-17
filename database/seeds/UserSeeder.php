<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'trieuniemit',
            'role_id' => 1,
            'phone' => '0283748234',
            'fullname' => 'Niem Trieu',
            'email' => 'trieuniemit@gmail.com',
            'password' => bcrypt('12345'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            'username' => 'huyho',
            'phone' => '0283748234',
            'fullname' => 'Huy Ho',
            'email' => 'b1.maitrongtoi@gmail.com',
            'password' => bcrypt('12345'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('users')->insert([
            'username' => 'truongtran',
            'phone' => '0283748234',
            'fullname' => 'Truong Tran',
            'email' => 'truongtran@gmail.com',
            'password' => bcrypt('12345'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
