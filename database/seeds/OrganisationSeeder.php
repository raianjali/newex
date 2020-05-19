<?php

use Illuminate\Database\Seeder;
use App\Organization;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::insert([
            ['city_id' => '1', 'title' => 'XYZ',  'name' => 'Convent School', 'email' => Str::random(10).'@gmail.com', 'logo' => 'abc.png', 'address' => 'Aurangabad, Mumbai', 'pincode' => '431002', 'landmark' => 'near watertank', 'established' => '1980-12-03', 'website' => 'www.xyz.com', 'affiliation_number' => '12345xyz', 'managing_committe' => 'abcdef'],
        ]);
    }
}
