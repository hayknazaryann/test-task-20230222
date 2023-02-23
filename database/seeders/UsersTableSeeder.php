<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Test User 1',
                'user_name' => 'testuser1',
                'password' => Hash::make('A4xurzLV')
            ],
            [
                'name' => 'Test User 2',
                'user_name' => 'testuser2',
                'password' => Hash::make('GXWgxH8S')
            ],
            [
                'name' => 'Test User 3',
                'user_name' => 'testuser3',
                'password' => Hash::make('fpg71XYF')
            ]
        ];

        User::upsert($users,['name', 'user_name', 'password']);
    }
}
