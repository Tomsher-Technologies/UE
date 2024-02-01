<?php

namespace App\Imports\Admin;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class SurchageImport implements ToCollection, WithValidation
{
    public $cus_errors;
    public $integrators;

    public function __construct()
    {
        $this->cus_errors = [];

        $this->integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'required',
            '10' => 'required',
            '11' => 'required',
            '12' => 'required',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'name',
            '1' => 'shippment type',
            '2' => 'integrator code',
            '3' => 'start weight',
            '4' => 'end weight',
            '5' => 'applied for',
            '6' => 'zone / country code',
            '7' => 'rate type',
            '8' => 'rate',
            '9' => 'start date',
            '10' => 'end date',
            '11' => 'applied per weight',
            '12' => 'sort order',
        ];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        $row_count = 2;

        foreach ($rows as $row) {
            if ($row[2] == 'all') {
                $integrator = 0;
            } else {
                $integrator = $this->integrators->where('internal_code', $row[2])->first()->id;
                if ($integrator == null) {
                    if (!in_array($row[2], $this->errors)) {
                        $this->cus_errors[] = $row[0];
                    }
                }
            }

            $startDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]));
            $endDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]));

            $surcharge = Surcharge::create([
                'name' => $row[0],
                'type' => $row[1],
                'integrator_id' => $integrator,
                'start_weight' => $row[3],
                'end_weight' => $row[4],
                'applied_for' => $row[5],
                'applied_for_id' => $row[6],
                'rate_type' => $row[7],
                'rate' => $row[8],
                'start_date' => $startDate->startOfDay(),
                'end_date' => $endDate->endOfDay(),
                'per_weight' => $row[11],
                'sort_order' => $row[12],
                'status' => 1,
            ]);

            $row_count++;
        }
    }
}
