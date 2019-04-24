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
        Eloquent::unguard();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data?')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh', ['--force' => true]);

            $this->command->line("Database cleared.");
        }

        $this->baseSeeders();

        // Ask for run fake seeder, default is no
        if ($this->command->confirm('Do you wish to run seeder for fake data?')) {
            $this->call(FakeSeeder::class);
        }

        // Re Guard model
        Eloquent::reguard();
    }

    protected function baseSeeders()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
