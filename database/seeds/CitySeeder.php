<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ['state_id' => '1', 'name' => 'Mumbai'],
            ['state_id' => '1', 'name' => 'Pune'],
            ['state_id' => '1', 'name' => 'Nagpur'],
            ['state_id' => '1', 'name' => 'Nashik'],

            ['state_id' => '2', 'name' => 'Bengaluru'],
            ['state_id' => '2', 'name' => 'Mysuru'],
            ['state_id' => '2', 'name' => 'Ballari'],
            ['state_id' => '2', 'name' => 'Bidar'],
            ['state_id' => '2', 'name' => 'Kolara'],
            ['state_id' => '2', 'name' => 'Udupi'],

            ['state_id' => '3', 'name' => 'New Delhi'],

            ['state_id' => '4', 'name' => 'Hyderabad'],

            ['state_id' => '5', 'name' => 'Los Angeles'],
            ['state_id' => '5', 'name' => 'San Francisco'],

            ['state_id' => '6', 'name' => 'Houston'],
            ['state_id' => '6', 'name' => 'Austin'],
        ]);
    }
}
