<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CyclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cycles')->insert([
            'id' => 1,
        	'name' => 'Primaire',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('cycles')->insert([
            'id' => 2,
        	'name' => 'Collège',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
        DB::table('cycles')->insert([
            'id' => 3,
        	'name' => 'Lycée',
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ]);
    }
}
