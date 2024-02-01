<?php

namespace App\Exports;

use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ZoneExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{

    public Request $request;

    public $zones;
    public $unique_countries;
    public $countries;

    public function __construct($request)
    {
        $this->request = $request;
        $this->zones = Zone::where('type', $this->request->type)->where('integrator_id', $this->request->integrator)->with('country')->get();
        $this->unique_countries = $this->zones->sortBy('country_id')->pluck('country_id')->unique()->toArray();

        $this->countries = Country::whereIn('id', $this->unique_countries)->orderBy('name')->get();
    }

    public function headings(): array
    {
        return [
            'Country',
            'Zone',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection1 = new Collection([]);
        foreach ($this->countries as $country) {
            $array = [];
            $array['country'] = $country->name;
            $zone = $this->zones->where('country_id', $country->id)->first()->zone_code;
            $array['zone'] = $zone;
            $collection1->push($array);
        }

        return $collection1;
    }

    public function title(): string
    {
        return 'Zones';
    }
}
