<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalController extends Controller
{
    public function rnd_data()
    {
         // Menentukan header 'x-api-key'
        $apiKey = 'testapi'; 
   
        // Lakukan request ke API
        $response = Http::withHeaders(['x-api-key' => $apiKey])
                    ->get('https://rnd.mycote.ch/api/activity-log');
    
        // Cek apakah request berhasil
        if ($response->ok()) {
            // Ambil teks dari response
            $jsonString = $response->body();
    
            // Ubah JSON menjadi array
            $data = json_decode($jsonString, true);
    
            // Kirim data ke view
            return view('admin.External.TestBibit', [
                'data' => $data
            ]);
        } else {
            // Handle jika request gagal
            return view('admin.External.TestBibit',  [
                'data' => 'Error'
            ]);
        }
    } 
}
