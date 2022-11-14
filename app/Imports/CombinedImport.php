<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CombinedImport implements WithMultipleSheets
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
    }

    public function sheets(): array
    {
        return [
            0 => new ZoneImport($this->integrator, $this->type),
            1 => new ImportRateImport($this->integrator, $this->headings, $this->type),
        ];
    }
}
