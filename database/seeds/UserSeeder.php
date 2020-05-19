<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['role_id' => '1', 'organization_id' => '1', 'name' => 'Anjali Super Admin', 'email' => 'super@gmail.com', 'roll_no' => '', 'password' => bcrypt('secret'), 'phone' => '12345', 'profile_pic' => 'anjali.jpg'],
            ['role_id' => '2', 'organization_id' => '1', 'name' => 'Anjali Admin', 'email' => 'admin@gmail.com', 'roll_no' => '', 'password' => bcrypt('secret'), 'phone' => '12345', 'profile_pic' => 'anjali.jpg'],
            ['role_id' => '3', 'organization_id' => '1', 'name' => 'Anjali Teacher', 'email' => 'teacher@gmail.com','roll_no' => '', 'password' => bcrypt('secret'), 'phone' => '12345', 'profile_pic' => 'anjali.jpg'],
            ['role_id' => '4', 'organization_id' => '1', 'name' => 'Anjali Student', 'email' => 'student@gmail.com', 'roll_no' => '1234567', 'password' => bcrypt('secret'), 'phone' => '12345', 'profile_pic' => 'anjali.jpg'],
        ]);
    }
}
