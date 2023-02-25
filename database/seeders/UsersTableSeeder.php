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
                'username' => 'testuser1',
                'password' => Hash::make('A4xurzLV')
            ],
            [
                'name' => 'Test User 2',
                'username' => 'testuser2',
                'password' => Hash::make('GXWgxH8S')
            ],
            [
                'name' => 'Test User 3',
                'username' => 'testuser3',
                'password' => Hash::make('fpg71XYF')
            ]
        ];

        User::upsert($users,['name', 'username', 'password']);
    }
}
