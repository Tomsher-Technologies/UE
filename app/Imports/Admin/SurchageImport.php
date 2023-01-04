<?php

namespace App\Imports\Admin;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToCollection;

class SurchageImport implements ToCollection
{
    public $errors;
    public $integrators;

    public function __construct()
    {
        $this->errors = [];

        $this->integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {

            if ($row[2] == 'all') {
                $integrator = 0;
            } else {
                $integrator = $this->integrators->where('integrator_code', $row[2])->first()->id;
                if ($integrator == null) {
                    if (!in_array($row[2], $this->errors)) {
                        $this->errors[] = $row[0];
                    }
                }
            }

            $surcharge = Surcharge::create([
                'name' => $row[0],
                'integrator_id' => $integrator,
                'start_weight' => $row[3],
                'end_weight' => $row[4],
                'applied_for' => $row[5],
                'applied_for_id' => $row[6],
                'rate' => $row[8],
                'rate_type' => $row[7],
                'type' => $row[1],
                'status' => 1,
            ]);
        }
    }
}
