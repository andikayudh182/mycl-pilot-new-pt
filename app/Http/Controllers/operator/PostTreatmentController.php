<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Pembibitan;
use App\Models\Baglog\BaglogRnD;
use App\Models\Mylea\Produksi;
use App\Models\Mylea\BaglogMylea;
use App\Models\Mylea\Elus;
use App\Models\Mylea\Kontaminasi;
use App\Models\Mylea\Panen;
use App\Models\PostTreatment\PostTreatment;
use App\Models\PostTreatment\PTProses;
use App\Models\PostTreatment\PostTreatmentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class PostTreatmentController extends Controller
{
    public function FormPostTreatmentSubmit(Request $request)
    {
        if(isset($request['id']) && $request['id'] != null){
            //validasi double
            $cm = array_column($request['data'], 'KodeMylea');
            if($cm != array_unique($cm)){
                return redirect()->back()->with('message2', 'Message : ' . "Terdapat data duplikat");
            }

            PostTreatment::where('id', $request['id'])->update([
                'Tanggal'=>$request['Tanggal'],
                'Batch'=>$request['Batch'],
            ]);
            echo $request['id'];

            if(isset($request['data'])){
                foreach($request->data as $key => $value){
                    PostTreatmentDetails::create([
                        'PT_ID'=> $request['id'],
                        'Panen_ID'=> $value['KodeMylea'],
                        'Jumlah'=> $value['Jumlah'],
                    ]);
                }
                $PostTreatmentDetails = PostTreatmentDetails::where('PT_ID', $request['id'])->get();
                PostTreatment::where('id', $request['id'])->update([
                    'Jumlah'=>$PostTreatmentDetails->sum('Jumlah'),
                ]);
            }
            return redirect()->back()->with('message', 'Data Updated');
        }
        $request->validate([
            'Tanggal'=> 'Required',
        ]);

        $id = Auth::user()->id;
        $Total = 0;

        //validasi double
        $cm = array_column($request['data'], 'KodeMylea');
        if($cm != array_unique($cm)){
            return redirect()->back()->with('message2', 'Message : ' . "Terdapat data duplikat");
        }

        $PT_ID = PostTreatment::create([
            'user_id'=>$id,
            'Tanggal'=>$request['Tanggal'],
            'Batch'=>$request['Batch'],
            'Jumlah'=>$Total,
        ])->id;

        foreach($request->data as $key => $value){
            PostTreatmentDetails::create([
                'PT_ID'=> $PT_ID,
                'Panen_ID'=> $value['KodeMylea'],
                'Jumlah'=> $value['Jumlah'],
            ]);

            $Total = $Total + $value['Jumlah'];
        }
        PostTreatment::where('id', $PT_ID)->update([
            'Jumlah'=>$Total,
        ]);
        return redirect()->back()->with('message', 'Form Submitted!');
    }

    public function AddMylea(Request $request)
    {
        foreach($request->data as $key => $value){
            PostTreatmentDetails::create([
                'PT_ID'=> $request['PT_ID'],
                'Panen_ID'=> $value['KodeMylea'],
                'Jumlah'=> $value['Jumlah'],
            ]);
        }
        $PostTreatmentDetails = PostTreatmentDetails::where('PT_ID'. $request['PT_ID'])->get();
        PostTreatment::where('id', $request['PT_ID'])->update([
            'Jumlah'=>$PostTreatmentDetails->sum('Jumlah'),
        ]);
        return redirect()->back()->with('message', 'Data Submitted!');
    }

    public function ProsesPostTreatment(Request $request){
        $request->validate([
            'Tanggal'=> 'Required',
        ]);

        $id = Auth::user()->id;
        if($request['id'] != '0'){
            PTProses::where('id', $request['id'])->update([
                'Tanggal'=>$request['Tanggal'],
                'JamMulai'=>$request['JamMulai'],
                'JamSelesai'=>$request['JamSelesai'],
                'Proses'=>$request['Proses'],
                'Jumlah'=>$request['Jumlah'],
                'Reject'=>$request['Reject'],
                'Notes'=>$request['Notes'],
            ]);
            return redirect()->back()->with('message', 'Data Updated');
        }
        PTProses::create([
            'user_id'=>$id,
            'Tanggal'=>$request['Tanggal'],
            'PT_ID'=>$request['PT_ID'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Proses'=>$request['Proses'],
            'Jumlah'=>$request['Jumlah'],
            'Reject'=>$request['Reject'],
            'Notes'=>$request['Notes'],
        ]);
        return redirect()->back()->with('message', 'Form Submitted!');
    }

    public function Monitoring(Request $request){
        $Data = PostTreatment::orderBy('Batch', 'desc')->where('Status', null)->paginate(80);
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            if($request['Status'] == ''){
                $request['Status'] = NULL;
            }
            $Data = PostTreatment::orderBy('Tanggal', 'desc')->whereBetween('Tanggal', [$Date1, $Date2])->where('Status', $request['Status'])->paginate(80);
        }
        //Get Post Treatment Details (Penggunaan Mylea)
        foreach ($Data as $data){
            $Panen = PostTreatmentDetails::select([
                'post_treatment_details.*',
                'mylea_panen.KPMylea',
            ])
            ->where('PT_ID', $data['id'])
            ->join('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
            ->get();
            $data['PTData'] = PTProses::where('PT_ID', $data['id'])->get();
            if(isset($Panen)){
                $data['Mylea'] = $Panen;
            }
        }
        $PostTreatment = PTProses::all();

        //Data untuk pilihan di form awal post treatment

        $Dat = Panen::with('PostTreatment', 'Kerik')
        //->whereRaw('Jumlah - (SELECT SUM(Jumlah) FROM post_treatment_details WHERE Panen_ID = mylea_panen.id) != 0')
        ->orderby('TanggalPanen', 'desc')
        ->get();

        $filteredData = [];

        foreach($Dat as $data){
            $TotalPT = $data['PostTreatment']->sum('Jumlah');
            $TotalRejectKerik = $data['Kerik']->sum('RejectBeforeKerik') + $data['Kerik']->sum('RejectAfterKerik');
            foreach($data['PostTreatment'] as $item){
                $item['Details'] = PostTreatment::where('id', $item['PT_ID'])->get()->first();
            }

            if(($data['Kerik']->sum('Jumlah') - $TotalPT) > 0){
                $data['InStock'] = $data['Kerik']->sum('Jumlah') - $TotalPT;
                $filteredData[] = $data;
            }
        }

        return view('operator.PostTreatment.Monitoring', [
            'Data'=>$Data,
            'PTData'=>$PostTreatment,
            'FormData'=>$filteredData,
        ]);
    }
     
    public function DeleteProses($id){
        PTProses::where('id', $id)->delete();
        return redirect()->back()->with('message2', 'Data Deleted');
    }

    public function DeleteMylea($id){
        PostTreatmentDetails::where('id', $id)->delete();
        return redirect()->back()->with('message2', 'Data Deleted');
    }

    public function Archive($id){
        PostTreatment::where('id', $id)->update([
            'Status'=>1,
        ]);
        return redirect()->back()->with('message', 'Data Archived');
    }
    
    public function MyleaPanen(Request $request)
    {
        $Dat = Panen::with('PostTreatment', 'Kerik')
        //->whereRaw('Jumlah - (SELECT SUM(Jumlah) FROM post_treatment_details WHERE Panen_ID = mylea_panen.id) != 0')
        ->orderby('TanggalPanen', 'desc')
        ->get();

        
        if(isset($request->Submit)) {
            $search = $request->SearchQuery;
            $Dat = Panen::with('PostTreatment', 'Kerik')
            ->where('KPMylea', 'like', "%" . $search . "%")
            ->orderBy('TanggalPanen', 'desc')
            ->get();
        }
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $Dat = Panen::with('PostTreatment', 'Kerik')
            ->whereBetween('TanggalPanen', [$Date1, $Date2])
            ->orderBy('TanggalPanen','desc')
            ->get();
        }

        $filteredData = [];
        $Total = 0;
        $TotalSudahKerik = 0;
        $TotalPTProses = 0;

        foreach($Dat as $data){
            $TotalPT = $data['PostTreatment']->sum('Jumlah');
            $TotalRejectKerik = $data['Kerik']->sum('RejectBeforeKerik') + $data['Kerik']->sum('RejectAfterKerik');

            //buat liat data yang masih on process tiap myleanya bisa pake array yang dibawah ini
            $data['OnGoingPT'] = 0;
            $TotalPTReject = 0;
            
            foreach($data['PostTreatment'] as $item){
                $item['Details'] = PostTreatment::where('id', $item['PT_ID'])->get()->first();
                $item['PTReject'] = PTProses::where('PT_ID', $data['PT_ID'])->get()->sum('Reject');
                
                if (isset($item['Details']) && $item['Details']['Status'] === null) {
                    $data['OnGoingPT'] += $item['Jumlah'];
                }
                $TotalPTReject += $item['PTReject'];
            }

            if(($data['Jumlah'] - ($TotalPT + $TotalRejectKerik)) != 0){
                $Total += $data['Jumlah'];
                $TotalPTProses = $TotalPTProses + ($data['OnGoingPT']);
                //Total mylea yang masih available (belum kerik + sudah dikerik)
                $TotalSudahKerik += $data['Kerik']->sum('Jumlah') + $TotalRejectKerik;
                $filteredData[] = $data;
            }
        }

        // added by dika
        $PTData = PostTreatment::orderBy('Batch', 'desc')->where('Status', null)->paginate(80);
        foreach ($PTData as $data) {
            $Panen = PostTreatmentDetails::select([
                'post_treatment_details.*',
                'mylea_panen.KPMylea',
            ])
            ->where('PT_ID', $data['id'])
            ->join('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
            ->get();

            $data['PTData'] = PTProses::where('PT_ID', $data['id'])->get();
            if(isset($Panen)){
                $data['Mylea'] = $Panen;
            }
    
        }

        $totalJumlah = 0;
        $totalRejectPanen = 0;
        $totalHasilKerik = 0;
        $totalRejectKerik = 0;
        $totalStokBelumDikerik = 0;
        $totalSisaBelumTerpakai = 0;

        foreach ($filteredData as $data) {
            $totalJumlah += $data['Jumlah'];
            $totalRejectPanen += $data['Kerik']->sum('RejectBeforeKerik');
            $totalHasilKerik += $data['Kerik']->sum('Jumlah');
            $totalRejectKerik += $data['Kerik']->sum('RejectAfterKerik');
            $totalStokBelumDikerik += $data['Jumlah']-$data['kerik']->sum('Jumlah')-$data['kerik']->sum('RejectBeforeKerik')-$data['kerik']->sum('RejectAfterKerik');
            $totalSisaBelumTerpakai += $data['kerik']->sum('Jumlah')-$data['PostTreatment']->sum('Jumlah');
        }



        return view('operator.PostTreatment.MyleaPanen', [
            'Data' => $Dat,
            'Trial'=>$filteredData,
            'PTData' => $PTData,
            'Total'=>$Total,
            'TotalSudahKerik'=>$TotalSudahKerik,
            'TotalPTProses'=>$TotalPTProses,
            'TotalRejectPanen'=> $totalRejectPanen,
            'TotalRejectKerik'=> $totalRejectKerik,
            'TotalSisaBelumTerpakai'=> $totalSisaBelumTerpakai,
        ]);
    }

}
