<?php

namespace App\Exports;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RateExport implements FromCollection, WithHeadings
{

    public Request $request;

    public $data;
    public $zone;
    public $zone_unique;
    public $unique_weight;

    public function __construct($request)
    {
        $this->request = $request;

        $query = Zone::where('type', $this->request->type);

        if ($this->request->integrator !== "0") {
            $query->where('integrator_id', $this->request->integrator);
        }
        if ($this->request->country !== "0") {
            $query->where('country_id', $this->request->country);
        }

        $this->zone = $query->select(['id', 'zone_code'])->get();

        // ddd($this->zone);

        $this->zone_unique = $this->zone->sortBy('zone_code')->pluck('zone_code')->unique()->toArray();

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
        $this->data = $model::with('zone')->where('integrator_id', $this->request->integrator)->get();
        $this->unique_weight = $this->data->pluck('weight')->unique();
    }

    public function headings(): array
    {
        $zone =  $this->zone_unique;
        array_unshift($zone, 'Weight');
        return $zone;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection1 = new Collection([]);

        foreach ($this->unique_weight as $weight) {

            $array = [];
            $array['weight'] = $weight;

            foreach ($this->zone_unique as  $zone) {
                $array[$zone]  = $this->data->where('zone.zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
            }

            $collection1->push($array);
        }
        return $collection1;
    }
}
