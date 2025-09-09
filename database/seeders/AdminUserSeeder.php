<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'smk6@gmail.com',
        ], [
            'name' => 'SMK 6 Guru',
            'password' => Hash::make('guru'),
        ]);
    }
}
