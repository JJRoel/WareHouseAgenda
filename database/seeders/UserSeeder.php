<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User One',
            'email' => 'userone@example.com',
            'password' => Hash::make('password1'),
        ]);

        User::create([
            'name' => 'User Two',
            'email' => 'usertwo@example.com',
            'password' => Hash::make('password2'),
        ]);
    }
}

