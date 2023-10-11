<?php

namespace App\Imports\TemperatureHumidity;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Mylea implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
