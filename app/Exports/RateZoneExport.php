<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RateZoneExport implements WithMultipleSheets
{

    public Request $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new RateExport($this->request);
        $sheets[] = new ZoneExport($this->request);

        return $sheets;
    }
}
