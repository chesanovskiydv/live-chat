<?php

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrInsert([
            'user_type_id' => UserType::where(['name' => UserType::SUPER_ADMIN])->first()->getKey(),
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            User::CREATED_AT => Date::now(),
            User::UPDATED_AT => Date::now()
        ]);
    }
}
