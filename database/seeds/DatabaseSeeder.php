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
        $this->call('UsersSeeder');
        $this->call('OptionsSeeder');
        $this->call('CyclesSeeder');

        $this->command->info('Seeding complete!');
    }
}
