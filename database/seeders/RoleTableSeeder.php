<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'admin',
        ]);
        Role::create([
            'role_name' => 'organisasi',
        ]);
        Role::create([
            'role_name' => 'donatur',
        ]);
    }
}
