<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
        	'name' => 'admin',
            'email' => 'admin@gmail.com',
            'class_id' => Null,
            'password' => bcrypt('azertazert'),
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
