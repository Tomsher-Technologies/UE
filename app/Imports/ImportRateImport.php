<?php

namespace App\Imports;

use App\Models\Rates\ImportRate;
use App\Models\Zones\Zone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportRateImport implements ToCollection
{

    private $integrator;
    private $headings;
    private $type;

    public $errors;

    public function __construct($integrator, $heading, $type)
    {
        $this->type = $type;
        $this->integrator = $integrator;
        $this->headings = $heading[0];
        $this->errors = [];
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        $remove = array_shift($this->headings);

        $heading_ids = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select(['id', 'zone_code'])->get();

        foreach ($rows as $row) {
            $weight = $row[0];
            foreach ($this->headings as $index => $headings) {
                if ($heading_ids->where('zone_code', $headings)->first()) {
                    ImportRate::updateOrCreate([
                        'integrator_id' => $this->integrator,
                        'weight' => $weight,
                        'zone_id' => $heading_ids->where('zone_code', $headings)->first()->id,
                    ], [
                        'rate' => $row[$index + 1] ?? 0
                    ]);
                } else {
                    if (!in_array($headings, $this->errors)) {
                        $this->errors[] = $headings;
                    }
                }
            }
        }
    }
}
