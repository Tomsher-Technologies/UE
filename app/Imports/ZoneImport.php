<?php

namespace App\Imports;

use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ZoneImport implements ToCollection
{

    private $integrator;
    private $type;

    public $errors;

    public function __construct($integrator, $type = 'import')
    {
        $this->type = $type;
        $this->integrator = $integrator;
        $this->errors = [];
    }

    public function checkRow($row, $count)
    {

        $status = true;

        if ($row[0] == '' || $row[0] == NULL || $row[0] == ' ') {
            $status = false;
            $this->errors[$count][] = "Country name is required";
        }

        if ($row[1] == '' || $row[1] == NULL || $row[1] == ' ') {
            $status = false;
            $this->errors[$count][] = "Country code is required";
        }

        if ($row[2] == '' || $row[2] == NULL || $row[2] == ' ') {
            $status = false;
            $this->errors[$count][] = "Zone  is required";
        }

        return $status;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        $countries = Country::latest()->get();

        $count = 2;

        foreach ($rows as $row) {

            $rowError = $this->checkRow($row, $count);

            if ($rowError) {
                $country = $countries
                    ->where('name', $row[0])
                    ->where('code', $row[1])
                    ->first();

                $c_name = $row[0];
                $c_code = $row[1];

                $country = $countries->filter(function ($item) use ($c_name, $c_code) {
                    return  stristr($item->code, $c_code);
                })->first();

                if (!$country) {
                    $country = Country::create([
                        'name' => $c_name,
                        'code' => $c_code,
                        'search_keyword' => ''
                    ]);
                }

                if ($row[2]) {
                    Zone::updateOrCreate([
                        'type' => $this->type,
                        'integrator_id' => $this->integrator,
                        'zone_code' => $row[2],
                        'country_id' => $country->id,
                    ]);
                }
            }

            $count++;
        }
    }
}
