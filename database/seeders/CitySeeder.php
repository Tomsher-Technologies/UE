<?php

namespace Database\Seeders;

use App\Models\Zone\Pincode;
use App\Models\Zones\City;
use App\Models\Zones\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $city = City::find(473);



        // $duplicates = DB::table('cities_2')
        //     ->select('country_code', 'city', DB::raw('COUNT(*) as `count`'))
        //     ->groupBy('city', 'country_code')
        //     ->havingRaw('COUNT(*) > 1')
        //     ->get();

        // $dc = [];

        // foreach ($duplicates as $duplicate) {
        //     // dd($duplicate);

        //     $dc[] = array(
        //         'country_code' => $duplicate->country_code,
        //         'city' => $duplicate->city,
        //     );

        //     $city = City::where([
        //         'country_code' => $duplicate->country_code,
        //         'city' => $duplicate->city,
        //     ])->skip(1)->take(1000)->get();

        //     foreach ($city as $c) {
        //         $c->delete();
        //     }
        // }

        // var_dump($dc);

        // 952355 
        // 553296


        // foreach (range($city->pincode , $city ) as $number) {
        //     echo $number . " \n";
        // }

        // for ($i = 1; $i < 952355; $i++) {
        //     $city = City::find($i);
        //     if ($city->pincode == '0' || $city->pincode == 0) {
        //     } else {
        //         if ($city->pincode !== $city->zip_to) {
        //             $from = (int)$city->pincode;
        //             $to = (int)$city->zip_to;
        //             if (
        //                 is_numeric($from) &&
        //                 is_numeric($to)
        //             ) {
        //                 $val = [];
        //                 foreach (range($from, $to) as $number) {
        //                     $val[] = $number;
        //                 }
        //                 $city->pincode = implode(',', $val);
        //                 $city->save();
        //             } else {
        //                 echo $city->id . " \n";
        //             }
        //         }
        //     }
        // }

        Pincode::truncate();

        // $csvFile = fopen("https://tomsher.co/allCountriesCSV.csv", "r");
        $csvFile = fopen(base_path("database/data/countrylist.csv"), "r");

        $firstline = true;

        // $countries = Country::all();

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $city = City::where([
                    'city' => Str::title($data['4']),
                    'country_code' => $data['0']
                ])->first();

                if ($city) {
                    $zip_from = $data['6'];
                    $zip_to = $data['7'];

                    if (
                        $zip_from == '' ||
                        $zip_from == null
                    ) {
                        Pincode::create([
                            'city_id' => $city->id,
                            'pincode' => 0
                        ]);
                    } else {
                        if ($zip_from == $zip_to) {
                            Pincode::create([
                                'city_id' => $city->id,
                                'pincode' => $zip_from
                            ]);
                        } else {
                            if (
                                is_numeric($zip_from) &&
                                is_numeric($zip_to)
                            ) {
                                foreach (range($zip_from, $zip_to) as $number) {
                                    Pincode::create([
                                        'city_id' => $city->id,
                                        'pincode' => $number
                                    ]);
                                }
                            } else {
                                Log::emergency('Country - ' . $city->country_code . ' --- ' . $city->city . ' ------ from - ' . $zip_from . ' ------ to - ' . $zip_to);
                            }
                        }
                    }
                }

                // City::create([
                //     'country_code' => $data['0'],
                //     "city" => Str::title($data['4']),
                //     "state" => $data['2']
                // ]);
            }
            $firstline = false;
        }

        fclose($csvFile);


        // City::truncate();

        // // $csvFile = fopen("https://tomsher.co/allCountriesCSV.csv", "r");
        // $csvFile = fopen(base_path("database/data/allCountriesCSV.csv"), "r");

        // $firstline = true;

        // $countries = Country::all();

        // while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $c_id = $countries->where('code', $data['0'])->pluck('id')->first();
        //         if ($c_id) {
        //             City::create([
        //                 'country_code' => $data['0'],
        //                 "city" => $data['2'],
        //                 "pincode" => $data['1'],
        //                 "state" => $data['3']
        //             ]);
        //         }
        //     }
        //     $firstline = false;
        // }

        // fclose($csvFile);
    }
}
