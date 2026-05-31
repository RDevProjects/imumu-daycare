<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin IMUMU',
            'email'    => 'admin@imumu.com',
            'phone'    => '081234567890',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
    }
}
