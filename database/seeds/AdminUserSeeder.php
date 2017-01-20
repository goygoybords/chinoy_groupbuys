<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('users')->insert([
            'email' => 'admin@chinoy-groupby.com',
            'password' => bcrypt('goygoy08'),
            'isAdmin' => 1,
            'token' => Hash::make(str_random(5)),
            'status' => 1
        ]);
    }
}
