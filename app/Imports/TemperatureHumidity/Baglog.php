<?php

namespace App\Imports\TemperatureHumidity;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Baglog implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
