<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'=>'admin',
            'full_name'=>'Mr. Admin',
            'mobile'=>'01721914666',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('1234'),
            'role'=>'0',
            'status'=>'1',
            'deleted'=>'0'
        ]);
    }
}
