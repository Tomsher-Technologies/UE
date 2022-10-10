<?php

namespace App\Exports;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RateByWeightExport implements FromCollection, WithHeadings
{

    public Request $request;

    public $data;

    public function __construct($request)
    {
        $this->request = $request;

        switch ($this->request->type) {
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
        $this->data = $model::with(['zone', 'integrator'])->where('weight', $request->weight)->get();
    }

    public function headings(): array
    {
        return [
            'Integrator',
            'Zone',
            'Weight',
            'Rate',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection1 = new Collection([]);
        foreach ($this->data as $data) {
            $array = [];

            $array['integrator'] = $data->integrator->name;
            $array['zone'] = $data->zone->zone_code;
            $array['weight'] = $data->weight;
            $array['rate'] = $data->rate;

            $collection1->push($array);
        }
        return $collection1;
    }
}
