<?php

namespace App\Imports\Admin;

use App\Models\Integrators\Integrator;
use App\Models\User;
use App\Models\Zones\Zone;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProfitMarginImport implements ToCollection
{

    public $errors;

    private $integrator;
    private $user;
    private $type;
    private $user_type;
    private $headings;

    public function __construct($user, $integrator, $type, $headings, $user_type = 'user')
    {
        $this->errors = [];

        $this->integrator = $integrator;
        $this->user = $user;
        $this->type = $type;
        $this->user_type = $user_type;
        $this->headings = $headings[0];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        $this->headings = array_slice($this->headings, 5);

        $this->headings = array_map('strtoupper', $this->headings);
        $this->headings = array_map('trim', $this->headings);

        $heading_ids = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select(['id', 'zone_code'])->get();

        // dd($heading_ids);

        foreach ($rows as $row) {

            $start_date =  Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]));

            if ($this->user_type == 'user') {
                if ($this->user) {

                    foreach ($this->headings as $index => $heading) {
                        if (Str::startsWith($heading, 'ZONE')) {
                            $zone = Str::remove('ZONE', $heading, false);
                            $zone = Str::remove('_', $zone, false);
                            $applied_for = 'zone';
                            $applied_for_id = $heading_ids->where('zone_code', $zone)->first()->id;
                            $applied_for_country = null;
                        } else {
                            $applied_for = 'country';
                            $applied_for_id = 0;
                            $applied_for_country = $heading;
                        }

                        $this->user->profitmargin()->updateOrCreate([
                            'integrator_id' => $this->integrator,
                            'type' => $this->type,
                            'product_type' => Str::lower($row[1]),
                            'start_date' => $start_date,
                            'applied_for' => $applied_for,
                            'applied_for_id' => $applied_for_id,
                            'applied_for_country' => $applied_for_country,
                            'weight' => $row[2] ? (float)$row[2] : 0.0,
                            'end_weight' => $row[3],
                            'rate_type' => 'percentage',
                        ], [
                            'rate' => $row[$index + 5] ? (float)$row[$index + 5] : 0
                        ]);
                    }
                } else {
                    if (!in_array($this->user->email, $this->errors)) {
                        $this->errors[] = $row[0] . '( ' . $row[1] . ' )';
                    }
                }
            }

            // if ($row[1] !== NULL) {
            //     $user_email = $row[1];
            //     $user = User::where('email', $user_email)->first();
            // }
        }
    }
}
