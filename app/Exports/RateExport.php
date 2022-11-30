<?php

namespace App\Exports;

use App\Models\Customer\Grade;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RateExport implements FromCollection, WithHeadings
{

    public Request $request;
    public Grade $grade;

    public $data;
    public $zone;
    public $zone_unique;
    public $unique_weight;

    public function __construct($request)
    {
        $this->request = $request;

        $query = Zone::where('type', $this->request->type);

        $this->grade = Grade::where('id', Auth::user()->grade_id)->first();

        if ($this->request->integrator !== "0") {
            $query->where('integrator_id', $this->request->integrator);
        }
        if ($this->request->country !== "0") {
            $query->where('country_id', $this->request->country);
        }

        $this->zone = $query->get();

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

        if ($this->request->weight) {
            $w = $this->data->where('weight', '>=', $this->request->weight)->pluck('weight')->unique()->first();
            $this->unique_weight = array($w);
        } else {
            $this->unique_weight = $this->data->pluck('weight')->unique();
        }
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
                $rate = $this->data->where('zone.zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
                // if ($rate !== 0) {

                //     $mzone = $this->zone->where('zone_code', $zone)->first();
                //     $mzone->weight = new Collection();
                //     $mzone->weight->rate = $rate;

                //     $rate += getFrofirMargin($this->request->integrator, $weight, $mzone, $this->request->country, $this->request->type, $this->grade);
                // }
                $array[$zone]  = $rate;
            }

            $collection1->push($array);
        }
        return $collection1;
    }
}
