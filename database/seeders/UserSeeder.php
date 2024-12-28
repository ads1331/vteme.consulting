<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Иванов', 'email' => 'test@test.ru']);
        User::create(['name' => 'Иванов2', 'email' => 'test2@test.ru']);
        User::create(['name' => 'Иванов3', 'email' => 'test3@test.ru']);
        User::create(['name' => 'Иванов4', 'email' => 'test4@test.ru']);
        User::create(['name' => 'Иванов5', 'email' => 'test5@test.ru']);
        User::create(['name' => 'Иванов6', 'email' => 'info@datainlife.ru']);
        User::create(['name' => 'Иванов7', 'email' => ' job@datainlife.ru']);

    }
}

