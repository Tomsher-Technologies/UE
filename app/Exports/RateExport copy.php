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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;


class RateExport implements FromCollection, WithHeadings, WithEvents
{

    public Request $request;

    public $data;
    public $zone;
    public $zone_unique;
    public $unique_weight = [];
    public $unique_types;

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
        $this->zone = $query->get();

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

        $this->data = $model::where('integrator_id', $this->request->integrator)->get();
        // $this->data = $model::with('zone')->where('integrator_id', $this->request->integrator)->get();

        $this->unique_types = $this->data->sortBy('pack_type')->pluck('pack_type')->unique()->toArray();

        if ($this->request->weight) {
            foreach ($this->unique_types as $unique_types) {
                $w = $this->data->where('pack_type', '=', $unique_types)->where('weight', '>=', $this->request->weight)->pluck('weight')->unique()->first();
                $this->unique_weight[$unique_types] = array($w);
            }
        } else {
            foreach ($this->unique_types as $unique_types) {
                $this->unique_weight[$unique_types] = $this->data->where('pack_type', '=', $unique_types)->pluck('weight')->unique();
            }
        }
    }

    public function headings(): array
    {
        $zone =  $this->zone_unique;
        array_unshift($zone, 'Type');
        array_unshift($zone, 'Weight');
        return $zone;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection1 = new Collection([]);

        foreach ($this->unique_types as $unique_types) {
            foreach ($this->unique_weight[$unique_types] as $weight) {

                $array = [];

                foreach ($this->zone_unique as  $zone) {
                    $rate = $this->data->where('zone_code', $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
                    if ($rate) {
                        $array['weight'] = $weight;
                        $array['type'] = $unique_types;
                        $array[$zone]  = $rate;
                    }
                }

                $collection1->push($array);
            }
        }


        return $collection1;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $highest = $event->sheet->getDelegate()->getHighestRowAndColumn();

                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'rotation' => 0,
                        'color' => ['rgb' => '000000'],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('A1:' . $highest['column'] . '1')
                    ->applyFromArray($styleArray);


                $event->sheet->getDelegate()->getStyle('A1')
                    ->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                        'fill' => [
                            'fillType' => 'solid',
                            'rotation' => 0,
                            'color' => ['rgb' => 'FFF000'],
                        ],
                    ]);

                $cell = "A" . ($highest['row'] + 5);
                $event->sheet->setCellValue($cell, 'Note: All rates are in AED');

                $event->sheet->getDelegate()->getStyle('A1:' . $highest['column'] . $highest['row'])
                    ->getAlignment()
                    ->applyFromArray(array(
                        'horizontal'       => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                        'vertical'         => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                        'wrap'         => TRUE
                    ));


                $sheet = $event->sheet;

                $event->sheet->addHeadingRows();

                // $sheet->mergeCells("A1:E1");
            },
        ];
    }
}

Sheet::macro('addHeadingRows', function (Sheet $sheet) {
    // $sheet->appendRow(array(
    //     'appended', 'appended'
    // ));
});
