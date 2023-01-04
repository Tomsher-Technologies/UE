<?php

namespace App\Imports\Admin;

use App\Models\Integrators\Integrator;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProfitMarginImport implements ToCollection
{

    public $errors;

    private $integrators;

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
            if ($row[1] !== NULL) {
                $user_email = $row[1];
                $user = User::where('email', $user_email)->first();

                if ($user) {
                    $integrator_id = $this->integrators->where('integrator_code', $row[3])->first();
                    $user->profitmargin()->updateOrCreate([
                        'integrator_id' => $integrator_id->id,
                        'type' => $row[4],
                        'applied_for' => $row[7],
                        'applied_for_id' => $row[8],
                        'weight' => $row[5],
                        'end_weight' => $row[6],
                        'rate_type' => 'percentage',
                    ], [
                        'rate' => $row[9]
                    ]);
                } else {
                    // dd($row);
                    if (!in_array($user_email, $this->errors)) {
                        $this->errors[] = $row[0] . '( ' . $row[1] . ' )';
                    }
                }
            }
        }
    }
}
