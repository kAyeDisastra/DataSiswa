<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ex.com',
            'password' => Hash::make('disastra'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@ex.com',
            'password' => Hash::make('1234'),
            'role' => 'user'
        ]);
    }
}
