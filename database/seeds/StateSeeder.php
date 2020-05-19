<?php

use Illuminate\Database\Seeder;
use App\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::insert([
            ['country_id' => '1', 'name' => 'Maharashtra'],
            ['country_id' => '1', 'name' => 'Karnataka'],
            ['country_id' => '1', 'name' => 'Delhi'],
            ['country_id' => '1', 'name' => 'Telengana'],
            ['country_id' => '2', 'name' => 'California'],
            ['country_id' => '2', 'name' => 'Texas'],
        ]);
    }
}
