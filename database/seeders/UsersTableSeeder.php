<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        $users = [
            [
                'name' => 'Luis',
                'username' => 'luis',
                'password' => Hash::make('0000'),
            ],
            [
                'name' => 'Gabriel',
                'username' => 'gabriel',
                'password' => Hash::make('1111'),
            ],
            [
                'name' => 'Sergio',
                'username' => 'sergio',
                'password' => Hash::make('2222'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}