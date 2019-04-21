<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            Role::ADMIN => 'Admin',
            Role::USER => 'User'
        ];

        foreach ($roles as $name => $title) {
            Role::updateOrInsert([
                'name' => $name,
                'title' => $title,
            ]);
        }
    }
}
