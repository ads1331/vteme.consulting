<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::create(['name' => 'Группа1', 'expire_hours' => 1]);
        Group::create(['name' => 'Группа2', 'expire_hours' => 2]);
        Group::create(['name' => 'Группа3', 'expire_hours' => 3]);
        Group::create(['name' => 'Группа4', 'expire_hours' => 4]);
        Group::create(['name' => 'Группа5', 'expire_hours' => 5]);
    }
}
