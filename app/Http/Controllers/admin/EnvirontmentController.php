<?php

namespace App\Http\Controllers\admin;
// use App\Models\Environment\TemperatureHumidity;
use App\Models\Environment\TemperatureHumidityMylea;
use App\Models\Environment\TemperatureHumidityBaglog;
use App\Models\Environment\TemperatureHumidityWstation;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Imports\TemperatureHumidityImport; 
use App\Imports\TemperatureHumidity\Mylea;
use App\Imports\TemperatureHumidity\Baglog;
use App\Imports\TemperatureHumidity\WorkingStation;

use Illuminate\Support\Str;


class EnvirontmentController extends Controller
{
    public function index() {
        return view('admin.Environtment.TemperatureHumidityMenu');
    }

    public function TemperatureHumidity() {
        return view('admin.Environtment.TemperatureHumidity');
    }

    public function TemperatureHumidityMylea(Request $request) {
        $MyleaRoom = TemperatureHumidityMylea::query();
    
        if (isset($request->Filter)) {
            if (isset($request['StartDate']) && isset($request['EndDate'])) {
                $startDate = date('Y-m-d', strtotime($request['StartDate']));
                $endDate = date('Y-m-d', strtotime($request['EndDate']));
    
                if ($startDate === $endDate) {
                    $MyleaRoom->whereDate('Time', $startDate);
                } else {
                    $MyleaRoom->whereBetween('Time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
            }
        }
    
 
        // Gabungkan orderBy dengan get()
        $MyleaRoom = $MyleaRoom->orderBy('Time', 'asc')->get();


    // Inisialisasi array untuk dataPoints Temperature dan Humidity
    $dataPointsTemperature = [];
    $dataPointsHumidity = [];

    // Loop melalui data dari $MyleaData
    // Loop melalui data dari $MyleaData
    foreach ($MyleaRoom as $data) {
        // Konversi format waktu ke UNIX timestamp
        $timestamp = strtotime($data->Time) * 1000;

        // Tambahkan data ke dalam dataPoints Temperature dalam format yang sesuai
        $dataPointsTemperature[] = [
            "x" => $timestamp,
            "y" => $data->Temperature
        ];

        // Tambahkan data ke dalam dataPoints Humidity dalam format yang sesuai
        $dataPointsHumidity[] = [
            "x" => $timestamp,
            "y" => $data->Humidity
        ];
    }

    
        return view('admin.Environtment.TemperatureHumidity.MyleaRoom', [
            'MyleaRoom' => $MyleaRoom,
            'dataPointsTemperature' => json_encode($dataPointsTemperature),
            'dataPointsHumidity' => json_encode($dataPointsHumidity)
        ]);
    }

    public function TemperatureHumidityBaglog(Request $request) {
        $BaglogRoom = TemperatureHumidityBaglog::query();
    
        if (isset($request->Filter)) {
            if (isset($request['StartDate']) && isset($request['EndDate'])) {
                $startDate = date('Y-m-d', strtotime($request['StartDate']));
                $endDate = date('Y-m-d', strtotime($request['EndDate']));
    
                if ($startDate === $endDate) {
                    $BaglogRoom->whereDate('Time', $startDate);
                } else {
                    $BaglogRoom->whereBetween('Time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
            }
        }
    
        $BaglogRoom = $BaglogRoom->orderBy('Time', 'asc')->get();


    // Inisialisasi array untuk dataPoints Temperature dan Humidity
    $dataPointsTemperature = [];
    $dataPointsHumidity = [];

    // Loop melalui data dari $MyleaData
    // Loop melalui data dari $MyleaData
    foreach ($BaglogRoom as $data) {
        // Konversi format waktu ke UNIX timestamp
        $timestamp = strtotime($data->Time) * 1000;

        // Tambahkan data ke dalam dataPoints Temperature dalam format yang sesuai
        $dataPointsTemperature[] = [
            "x" => $timestamp,
            "y" => $data->Temperature
        ];

        // Tambahkan data ke dalam dataPoints Humidity dalam format yang sesuai
        $dataPointsHumidity[] = [
            "x" => $timestamp,
            "y" => $data->Humidity
        ];
    }

    
        return view('admin.Environtment.TemperatureHumidity.BaglogRoom', [
            'BaglogRoom' => $BaglogRoom,
            'dataPointsTemperature' => json_encode($dataPointsTemperature),
            'dataPointsHumidity' => json_encode($dataPointsHumidity)
        ]);
    }

    public function TemperatureHumidityWstation(Request $request) {
        $WorkingStationRoom = TemperatureHumidityWstation::query();
    
        if (isset($request->Filter)) {
            if (isset($request['StartDate']) && isset($request['EndDate'])) {
                $startDate = date('Y-m-d', strtotime($request['StartDate']));
                $endDate = date('Y-m-d', strtotime($request['EndDate']));
    
                if ($startDate === $endDate) {
                    $WorkingStationRoom->whereDate('Time', $startDate);
                } else {
                    $WorkingStationRoom->whereBetween('Time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
            }
        }
    
        $WorkingStationRoom = $WorkingStationRoom->orderBy('Time', 'asc')->get();


    // Inisialisasi array untuk dataPoints Temperature dan Humidity
    $dataPointsTemperature = [];
    $dataPointsHumidity = [];

    // Loop melalui data dari $MyleaData
    // Loop melalui data dari $MyleaData
    foreach ($WorkingStationRoom as $data) {
        // Konversi format waktu ke UNIX timestamp
        $timestamp = strtotime($data->Time) * 1000;

        // Tambahkan data ke dalam dataPoints Temperature dalam format yang sesuai
        $dataPointsTemperature[] = [
            "x" => $timestamp,
            "y" => $data->Temperature
        ];

        // Tambahkan data ke dalam dataPoints Humidity dalam format yang sesuai
        $dataPointsHumidity[] = [
            "x" => $timestamp,
            "y" => $data->Humidity
        ];
    }

    
        return view('admin.Environtment.TemperatureHumidity.WorkingStationRoom', [
            'WorkingStationRoom' => $WorkingStationRoom,
            'dataPointsTemperature' => json_encode($dataPointsTemperature),
            'dataPointsHumidity' => json_encode($dataPointsHumidity)
        ]);
    }

    // public function TemperatureHumidityWstation() {
    //     return view('admin.Environtment.TemperatureHumidity.WorkingStationRoom');
    // }


    public function ImportTemperatureHumidityMylea(Request $request) {
        
            // Validasi file Excel yang diunggah
            $request->validate([
                'TemperatureHumidity' => 'required|mimes:xls,xlsx',
            ]);

            $fileName = $request->file('TemperatureHumidity')->getClientOriginalName();
            if (!Str::contains(strtolower($fileName), 'mylea')) {
                return redirect()->route('temperature-humidity.mylea')
                    ->with('error', 'File name must contain "mylea" or "Mylea"');
            }

        try {
            // Menggunakan Maatwebsite Excel untuk membaca file
            $data = Excel::toArray(new Mylea, $request->file('TemperatureHumidity'));
    
            $importedData = $data[0]; // Data Excel akan ada di indeks pertama dari array
    
            foreach ($importedData as $row) {
                TemperatureHumidityMylea::updateOrInsert(
                    ['Time' => $row[1]],
                    [
                        'Temperature' => $row[2],
                        'Humidity' => $row[3],
                    ]
                );
            }
    
            return redirect()->route('temperature-humidity.mylea')
                ->with('success', 'Mylea Room Temperature Humidity data successfully imported');
        } catch (\Exception $e) {
            // Tangani pengecualian di sini, misalnya:
            return redirect()->route('temperature-humidity.mylea')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function ImportTemperatureHumidityWstation(Request $request) {
        
            // Validasi file Excel yang diunggah
            $request->validate([
                'TemperatureHumidity' => 'required|mimes:xls,xlsx',
            ]);

            // Memeriksa nama file
            $fileName = $request->file('TemperatureHumidity')->getClientOriginalName();
            if (!Str::contains(strtolower($fileName), 'working')) {
                return redirect()->route('temperature-humidity.working-station')
                    ->with('error', 'File name must contain "working-station" or "Working"');
            }

        try {
            // Menggunakan Maatwebsite Excel untuk membaca file
            $data = Excel::toArray(new WorkingStation, $request->file('TemperatureHumidity'));
    
            $importedData = $data[0]; // Data Excel akan ada di indeks pertama dari array
    
            foreach ($importedData as $row) {
                TemperatureHumidityWstation::updateOrInsert(
                    ['Time' => $row[1]],
                    [
                        'Temperature' => $row[2],
                        'Humidity' => $row[3],
                    ]
                );
            }
    
            return redirect()->route('temperature-humidity.working-station')
                ->with('success', 'Working Station Room Temperature Humidity data successfully imported');
        } catch (\Exception $e) {
            // Tangani pengecualian di sini, misalnya:
            return redirect()->route('temperature-humidity.working-station')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function ImportTemperatureHumidityBaglog(Request $request) {
        
            // Validasi file Excel yang diunggah
            $request->validate([
                'TemperatureHumidity' => 'required|mimes:xls,xlsx',
            ]);

            // Memeriksa nama file
            $fileName = $request->file('TemperatureHumidity')->getClientOriginalName();
            if (!Str::contains(strtolower($fileName), 'baglog')) {
                return redirect()->route('temperature-humidity.baglog')
                    ->with('error', 'File name must contain "baglog" or "Baglog"');
            }

        try {
            // Menggunakan Maatwebsite Excel untuk membaca file
            $data = Excel::toArray(new Baglog, $request->file('TemperatureHumidity'));
    
            $importedData = $data[0]; // Data Excel akan ada di indeks pertama dari array
    
            foreach ($importedData as $row) {
                TemperatureHumidityBaglog::updateOrInsert(
                    ['Time' => $row[1]],
                    [
                        'Temperature' => $row[2],
                        'Humidity' => $row[3],
                    ]
                );
            }
    
            return redirect()->route('temperature-humidity.baglog')
                ->with('success', 'Baglog Room Temperature Humidity data successfully imported');
        } catch (\Exception $e) {
            // Tangani pengecualian di sini, misalnya:
            return redirect()->route('temperature-humidity.baglog')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    

    public function CO2() {
        return view('admin.Environtment.CO2.CO2');
    }
}
