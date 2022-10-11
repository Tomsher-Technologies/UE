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
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        $rows->shift();

        $countries = Country::latest()->get();

        foreach ($rows as $row) {
            $country = $countries
                ->where('name',)
                ->where('code', $row[1])
                ->first();

            $c_name = $row[0];
            $c_code = $row[1];

            $country = $countries->filter(function ($item) use ($c_name, $c_code) {
                return  stristr($item->name, $c_name) || stristr($item->code, $c_code);
            })->first();

            if ($country) {
                if ($row[2]) {
                    Zone::updateOrCreate([
                        'type' => $this->type,
                        'integrator_id' => $this->integrator,
                        'zone_code' => $row[2],
                        'country_id' => $country->id,
                    ]);
                }
            } else {
                if (!in_array($row[0], $this->errors)) {
                    $this->errors[] = $row[0] . '( ' . $row[1] . ' )';
                }
            }
        }
    }
}
