<?php

namespace Database\Seeders;

use App\Models\Zones\City;
use App\Models\Zones\Country;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        City::truncate();

        // $csvFile = fopen("https://tomsher.co/allCountriesCSV.csv", "r");
        $csvFile = fopen(base_path("database/data/allCountriesCSV.csv"), "r");

        $firstline = true;

        $countries = Country::all();

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $c_id = $countries->where('code', $data['0'])->pluck('id')->first();
                if ($c_id) {
                    City::create([
                        'country_id' => $c_id,
                        "city" => $data['2'],
                        "pincode" => $data['1'],
                        "state" => $data['3']
                    ]);
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
