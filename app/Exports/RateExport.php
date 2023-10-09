<?php

namespace App\Exports;

use App\Models\Customer\CustomerRates;
use App\Models\Customer\Grade;
use App\Models\Integrators\Integrator;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class RateExport implements FromCollection, WithHeadings, WithEvents, WithTitle, WithDrawings
{

    public Request $request;

    public $data;
    public $zone;
    public $integrator;
    public $zone_unique;
    public $unique_weight = [];
    public $unique_types;
    public $color = "000000";
    public $bg_color = "FFFFFF";

    // Constants
    public $pac_type = "pack_type";
    public $zone_code = "zone_code";

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

        if (Auth::user()->isA('reseller')) {
            $user_rate = CustomerRates::where('user_id', auth()->user()->id)
                ->where('integrator_id',  $this->request->integrator)
                ->where('type', $this->request->type)
                ->get();

            if ($user_rate) {
                $this->pac_type = 'pac_type';
                $this->zone_code = 'zone';
                $this->data = $user_rate;
            }
        }

        $this->unique_types = $this->data->sortBy($this->pac_type)->pluck($this->pac_type)->unique()->toArray();

        // dd($this->unique_types);

        if ($this->request->weight) {
            foreach ($this->unique_types as $unique_types) {
                $w = $this->data->where($this->pac_type, '=', $unique_types)->where('weight', '>=', $this->request->weight)->pluck('weight')->unique()->first();
                $this->unique_weight[$unique_types] = array($w);
            }
        } else {
            foreach ($this->unique_types as $unique_types) {
                $this->unique_weight[$unique_types] = $this->data->where($this->pac_type, '=', $unique_types)->pluck('weight')->unique();
            }
        }

        $this->integrator = Integrator::where('id', $this->request->integrator)->first();
        if ($this->integrator) {

            if ($this->integrator->integrator_code == "aramex") {
                $this->color = "FFFFFF";
                $this->bg_color = "FF1105";
            }
            if ($this->integrator->integrator_code == "dhl") {
                $this->color = "D81635";
                $this->bg_color = "FFCB05";
            }
            if ($this->integrator->integrator_code == "fedex") {
                $this->color = "FFFFFF";
                $this->bg_color = "4F0470";
            }
            if ($this->integrator->integrator_code == "ups") {
                $this->color = "FFFFFF";
                $this->bg_color = "FEB501";
            }
        }
    }

    public function headings(): array
    {
        $zone = $this->zone_unique;
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
                    $rate = $this->data->where($this->zone_code, $zone)->where('weight', $weight)->pluck('rate')->first() ?? 0;
                    if ($rate) {
                        $array['weight'] = $weight;
                        $array['type'] = $unique_types;
                        $array[$zone]  = $rate;
                    }
                }

                $collection1->push($array);
            }
        }

        if ($collection1->count() <= 0) {
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
                        'color' => ['rgb' => $this->color],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'rotation' => 0,
                        'color' => ['rgb' => $this->bg_color],
                    ]
                ];

                $event->sheet->getDelegate()->getStyle('A6:' . $highest['column'] . '6')
                    ->applyFromArray($styleArray);

                $event->sheet->getDelegate()->getRowDimension('6')->setRowHeight(20);

                // $event->sheet->getDelegate()->getStyle('A1')
                //     ->applyFromArray([
                //         'font' => [
                //             'bold' => true,
                //             'color' => ['rgb' => 'FFFFFF'],
                //         ],
                //         'fill' => [
                //             'fillType' => 'solid',
                //             'rotation' => 0,
                //             'color' => ['rgb' => 'FFF000'],
                //         ],
                //     ]);

                $cell = "A" . ($highest['row'] + 5);
                $event->sheet->setCellValue($cell, 'Note: All rates are in AED');

                $event->sheet->getDelegate()->getStyle('A1:' . $highest['column'] . $highest['row'])
                    ->getAlignment()
                    ->applyFromArray(array(
                        'horizontal'       => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'         => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                        'wrap'         => TRUE
                    ));


                $sheet = $event->sheet;

                $event->sheet->addHeadingRows();
            }, BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->insertNewRowBefore(1, 4);
                $sheet->mergeCells("A1:E5");
                $sheet->mergeCells("F1:J5");
            },
        ];
    }

    public function title(): string
    {
        return 'Rate';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Linex');
        $drawing->setPath(public_path('/images/logo.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B2');

        $drawing2 = new Drawing();
        $drawing2->setName($this->integrator->name);
        $drawing2->setPath(storage_path('app/' . $this->integrator->logo));
        $drawing2->setHeight(50);
        $drawing2->setCoordinates('F2');

        return [$drawing, $drawing2];
    }
}

Sheet::macro('addHeadingRows', function (Sheet $sheet) {
    // $sheet->appendRow(array(
    //     'appended', 'appended'
    // ));
});
