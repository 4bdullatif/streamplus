<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries_list = file_get_contents('https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/refs/heads/master/json/countries%2Bstates.json');

        $countries = json_decode($countries_list, true);
        foreach ($countries as $country) {
            $country_id = DB::table('countries')->insertGetId([
                'name' => $country['name'],
                'code' => $country['iso3'],
                'phone_code' => $country['phone_code'],
                'is_active' => true,
                'has_states' => count($country['states']) > 0,
            ]);

            foreach ($country['states'] as $state) {
                DB::table('states')->insert([
                    'name' => $state['name'],
                    'code' => $state['state_code'],
                    'country_id' => $country_id,
                    'is_active' => true,
                ]);
            }
        }
    }
}
