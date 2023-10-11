<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Environment\TemperatureHumidity; // Sesuaikan dengan namespace yang sesuai

class TemperatureHumidityImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Pastikan format kolom sesuai dengan file Excel Anda
            $data = [
                'Time' => $row[1],         // Kolom waktu sesuai dengan posisi dalam file Excel
                'Temperature' => $row[2],  // Kolom suhu sesuai dengan posisi dalam file Excel
                'Humidity' => $row[3],     // Kolom kelembaban sesuai dengan posisi dalam file Excel
            ];
        
            // Simpan data ke dalam database (model TemperatureHumidity)
            TemperatureHumidity::create($data);
        }
        
    }
}

?>