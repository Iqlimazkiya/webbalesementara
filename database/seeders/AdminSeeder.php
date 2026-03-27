<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

    User::updateOrCreate(
    ['email' => 'ahmadchoirul598@gmail.com'],
    [
        'name' => 'Admin',
        'password' => bcrypt('password'),
    ]
);
    }
}
