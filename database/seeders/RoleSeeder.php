<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //eloquent : query builder/orm larvel
        Role::insert([
            ['name' => 'Administrator'],
            ['name' => 'Kasir'],
            ['name' => 'Pimpinan'],
        ]);
    }
}
