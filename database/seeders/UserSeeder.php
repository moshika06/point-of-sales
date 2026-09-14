<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'Administrator')->first();
        $kasir = Role::where('name', 'Kasir')->first();
        $pimpinan = Role::where('name', 'Pimpinan')->first();
        User::create(['name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'role_id' => $admin->id,]);
        User::create(['name' => 'Cashier', 'email' => 'kasir@gmail.com', 'password' => Hash::make('12345678'), 'role_id' => $kasir->id,]);
        User::create(['name' => 'Pimpinan', 'email' => 'pimpinan@gmail.com', 'password' => Hash::make('12345678'), 'role_id' => $pimpinan->id,]);
    }
}
