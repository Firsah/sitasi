<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['role' => 'super admin']);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'role_id' => $role->id
        ]);
    }
}
