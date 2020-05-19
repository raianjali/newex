<?php

use App\City;
use App\Country;
use App\Organization;
use App\State;
use App\User;
use App\Role;
//use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            OrganisationSeeder::class,
            UserSeeder::class
        ]);
    }
}
