<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTreatment\PostTreatment;
use App\Models\PostTreatment\PostTreatmentDetails;
use App\Models\Mylea\Panen;
use App\Models\PostTreatment\PTProses;
use App\Models\PostTreatment\Curing;

class CuringController extends Controller
{
    public function CuringIndex(Request $request)
    {
        $Data = PostTreatment::orderBy('post_treatment.Tanggal', 'desc')
        ->where('Status', null)
        ->join('post_treatment_proses', function ($join) {
            $join->on('post_treatment.id', '=', 'post_treatment_proses.PT_ID')
                ->where('post_treatment_proses.Proses', '=', 'Drying')
                ->where('post_treatment_proses.Jumlah', '>', 0);
        })
        ->selectRaw('post_treatment.*')
        ->selectRaw('post_treatment.Tanggal AS TanggalPostTreatment')
        ->selectRaw('post_treatment_proses.*')
        ->selectRaw('post_treatment_proses.Tanggal AS TanggalDrying')
        ->paginate(20);
    
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            if($request['Status'] == ''){
                $request['Status'] = NULL;
            }
            $Data = PostTreatment::orderBy('post_treatment.Tanggal', 'desc')
                    ->whereBetween('post_treatment.Tanggal', [$Date1, $Date2])
                    ->where('Status', $request['Status'])
                    ->join('post_treatment_proses', function ($join) {
                        $join->on('post_treatment.id', '=', 'post_treatment_proses.PT_ID')
                            ->where('post_treatment_proses.Proses', '=', 'Drying')
                            ->where('post_treatment_proses.Jumlah', '>', 0);
                    })
                    ->selectRaw('post_treatment.*')
                    ->selectRaw('post_treatment.Tanggal AS TanggalPostTreatment')
                    ->selectRaw('post_treatment_proses.*')
                    ->selectRaw('post_treatment_proses.Tanggal AS TanggalDrying')
                    ->paginate(200);
        }
        $totalGradeA = 0;
        $totalGradeB = 0;
        $totalGradeC = 0;
        $totalGradeD = 0;

        //Get Post Treatment Details (Penggunaan Mylea)
        foreach ($Data as $data) {
            $Panen = PostTreatmentDetails::select([
                'post_treatment_details.*',
                'mylea_panen.KPMylea',
            ])
                ->where('PT_ID', $data['PT_ID'])
                ->join('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
                ->get();
        
            $data['PTData'] = PTProses::where('PT_ID', $data['PT_ID'])->get();
            $data['Curing'] = Curing::where('PT_ID', $data['PT_ID'])->get();
             foreach ($data['Curing'] as $curing){
                
                    $totalGradeA +=$curing['SizeSatu'] ;
                    $totalGradeB +=$curing['SizeDua'] ;
                    $totalGradeC +=$curing['SizeTiga'] ;
                    $totalGradeD +=$curing['SizeEmpat'] ;
             }
            
            if (isset($Panen)) {
                $data['Mylea'] = $Panen;
            }
        
            // Inisialisasi JumlahFatliquor menjadi 0
            $data['JumlahFatliquor'] = 0;
        
            // Loop melalui data PTData dan tambahkan Jumlah jika kondisinya adalah 'Fat Liquor'
            foreach ($data['PTData'] as $pt) {
                if ($pt['Proses'] === 'Fat Liquor') {
                    $data['JumlahFatliquor'] += $pt['Jumlah'];
                }
            }

            if ($data['JumlahFatliquor'] > 0) {
                // Jika JumlahFatliquor lebih dari 0, tambahkan 4 hari
                $data['ScheduleFinishCuring'] = date('Y-m-d', strtotime($data['TanggalDrying'] . ' +4 days'));
            } else {
                // Jika JumlahFatliquor tidak lebih dari 0, tambahkan 6 hari
                $data['ScheduleFinishCuring'] = date('Y-m-d', strtotime($data['TanggalDrying'] . ' +6 days'));
            }
            
        }
        
        return view('admin.Curing.Index', [
            'Data' => $Data,
            'totalGradeA' => $totalGradeA,
            'totalGradeB' => $totalGradeB,
            'totalGradeC' => $totalGradeC,
            'totalGradeD' => $totalGradeD,
        ]);
    }

    public function UpdateActualFinishCuring (Request $request) {
        
        $PT_ID= $request['PT_ID'];

        try {
            $CuringDetails = Curing::where('PT_ID', $PT_ID)->first();

            if (!$CuringDetails) {
                Curing::create([
                    'PT_ID' => $PT_ID,
                    'ActualFinishCuring' => $request['ActualFinishCuring'],
                ]);
            } else {
                Curing::where('PT_ID', $PT_ID)->update([
                    'ActualFinishCuring' => $request['ActualFinishCuring'],
                ]);
            }

            return redirect(route('CuringIndex'))->with('Success', 'Update Actual Finish Curing Success!');
        } catch (\Exception $e) {
            return redirect(route('CuringIndex'))->with('Error', 'Message : ' . $e->getMessage());
        }

        
    }
    public function UpdateCuringSize(Request $request)
    {
        $PT_ID = $request['PT_ID'];
    
        // $curing = Curing::where('PT_ID', $PT_ID)->first();
    
        // if (!$curing) {
        //     return redirect(route('CuringIndex'))->with('Error', 'Please input actual finish curing first !!' );
        // }
    
        try {
            Curing::updateOrInsert(
                ['PT_ID' => $PT_ID],
                [
                    'TanggalPengerjaan' => $request['TanggalPengerjaan'],
                    'Warna' => $request['Warna'],
                    'SizeSatu' => $request['SizeSatu'],
                    'SizeDua' => $request['SizeDua'],
                    'SizeTiga' => $request['SizeTiga'],
                    'SizeEmpat' => $request['SizeEmpat'],
                ]
            );
    
            return redirect(route('CuringIndex'))->with('Success', 'Update Curing Size Success!');
        } catch (\Exception $e) {
            return redirect(route('CuringIndex'))->with('Error', 'Message: ' . $e->getMessage());
        }
    }
    
}
