<?php

namespace App\Imports;

use App\Models\Zones\OdPincodes;
use Maatwebsite\Excel\Concerns\ToModel;

class ODPicodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OdPincodes([
            //
        ]);
    }
}
