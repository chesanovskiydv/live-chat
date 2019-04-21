<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            UserType::SUPER_ADMIN => 'Super Admin',
            UserType::CUSTOMER => 'Customer',
        ];

        foreach ($roles as $name => $title) {
            UserType::updateOrInsert([
                'name' => $name,
                'title' => $title,
            ]);
        }
    }
}
