<?php

namespace App\Imports;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportRateImport implements ToCollection
{

    private $integrator;
    private $headings;
    private $type;

    public $errors;

    public function __construct($integrator, $heading, $type = 'import')
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

        switch ($this->type) {
            case "import":
                $model = new ImportRate();
                break;
            case "export":
                $model = new ExportRate();
                break;
            case "transit":
                $model = new TransitRate();
                break;
        }

        $heading_ids = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select(['id', 'zone_code'])->get();

        // ddd($this->headings);
        // ddd( $heading_ids);
        $this->headings = array_map('strtoupper', $this->headings);
        $this->headings = array_map('trim', $this->headings);


        foreach ($rows as $row) {
            $weight = $row[0];
            foreach ($this->headings as $index => $headings) {
                if ($heading_ids->where('zone_code', $headings)->first()) {
                    $model::updateOrCreate([
                        'integrator_id' => $this->integrator,
                        'weight' => (double)$weight,
                        'zone_id' => $heading_ids->where('zone_code', $headings)->first()->id,
                    ], [
                        'rate' => $row[$index + 1] ? (float)$row[$index + 1] : 0
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
