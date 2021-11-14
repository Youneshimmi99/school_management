<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'id' => 1,
        	'name' => 'arabe',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

        DB::table('options')->insert([
            'id' => 2,
        	'name' => 'français',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);

        DB::table('options')->insert([
            'id' => 3,
        	'name' => 'anglais',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
