<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'super_admin'],
            ['name' => 'admin'],
            ['name' => 'teacher'],
            ['name' => 'student'],
        ]);
        
    }
}
