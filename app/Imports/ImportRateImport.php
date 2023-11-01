<?php

namespace App\Imports;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\OverWeightRate;
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
        $remove = array_shift($this->headings);

        switch ($this->type) {
            case "import":
                $model = new ImportRate();
                break;
            case "export":
                $model = new ExportRate();
                break;
            case "transit":
                $this->type = 'transit';
                $model = new TransitRate();
                break;
        }

        $heading_ids = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select(['id', 'zone_code'])->get();

        $this->headings = array_map('strtoupper', $this->headings);
        $this->headings = array_map('trim', $this->headings);

        $weights = [];

        // Delete Old Rate
        OverWeightRate::where([
            'integrator_id' => $this->integrator,
            'shipment_type' => $this->type,
        ])->delete();

        $model::where([
            'integrator_id' => $this->integrator,
        ])->delete();

        foreach ($rows as $row) {
            $weight = $row[0];

            $weight_break = explode('-', $weight);

            $pack_type = $row[1];
            foreach ($this->headings as $index => $heading) {
                if ($heading_ids->where('zone_code', $heading)->first()) {
                    // if weight break is specified
                    if (isset($weight_break[1])) {
                        $model = OverWeightRate::updateOrCreate([
                            'integrator_id' => $this->integrator,
                            'from_weight' => (float)$weight_break[0],
                            'end_weight' => (float)$weight_break[1],
                            'zone_id' => $heading_ids->where('zone_code', $heading)->first()->id,
                            // 'zone_id' => 1,
                            'zone_code' => $heading,
                            'shipment_type' => $this->type,
                            'pack_type' => $pack_type
                        ], [
                            'rate' => $row[$index + 2] ? (float)$this->cleanRate($row[$index + 2]) : 0
                        ]);
                    } else {
                        $model = $model::updateOrCreate([
                            'integrator_id' => $this->integrator,
                            'weight' => (float)$weight,
                            'zone_id' => $heading_ids->where('zone_code', $heading)->first()->id,
                            'zone_code' => $heading,
                            'pack_type' => $pack_type
                        ], [
                            'rate' => $row[$index + 2] ? (float)$this->cleanRate($row[$index + 2]) : 0
                        ]);
                    }
                } else {
                    if (!in_array($heading, $this->errors)) {
                        $this->errors[] = $heading;
                    }
                }
            }
        }
    }

    public function cleanRate($rate)
    {
        return str_replace(',', '', $rate);
    }
}
