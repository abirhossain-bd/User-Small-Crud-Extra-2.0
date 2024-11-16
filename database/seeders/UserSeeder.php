<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','user@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user@1234'),
            ]);
        }
        $user->update([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user@1234'),
        ]);
    }
}
