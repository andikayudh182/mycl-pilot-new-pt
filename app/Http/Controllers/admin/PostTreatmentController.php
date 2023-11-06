<?php

namespace App\Http\Controllers\admin;

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
use App\Models\PostTreatment\PTKerik;
use App\Models\PostTreatment\PTRebus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use PDO;

class PostTreatmentController extends Controller
{
    public function Index()
    {
        return view('admin.PostTreatmentIndex');
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


        return view('admin.PostTreatment.MyleaPanen', [
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

    public function MyleaHarvest(Request $request)
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
        // $totalHasilKerik = 0;
        // $totalRejectKerik = 0;
        // $totalStokBelumDikerik = 0;
        // $totalSisaBelumTerpakai = 0;

        foreach ($filteredData as $data) {
            $totalJumlah += $data['Jumlah'];
            $totalRejectPanen += $data['Kerik']->sum('RejectBeforeKerik');
            // $totalHasilKerik += $data['Kerik']->sum('Jumlah');
            // $totalRejectKerik += $data['Kerik']->sum('RejectAfterKerik');
            // $totalStokBelumDikerik += $data['Jumlah']-$data['kerik']->sum('Jumlah')-$data['kerik']->sum('RejectBeforeKerik')-$data['kerik']->sum('RejectAfterKerik');
            // $totalSisaBelumTerpakai += $data['kerik']->sum('Jumlah')-$data['PostTreatment']->sum('Jumlah');
        }


        return view('admin.PostTreatment.MyleaHarvest', [
            'Data' => $Dat,
            'Trial'=>$filteredData,
            'PTData' => $PTData,
            'Total'=>$Total,
            'TotalSudahKerik'=>$TotalSudahKerik,
            'TotalPTProses'=>$TotalPTProses,
            'TotalRejectPanen'=> $totalRejectPanen,
            // 'TotalRejectKerik'=> $totalRejectKerik,
            // 'TotalSisaBelumTerpakai'=> $totalSisaBelumTerpakai,
        ]);
    }

    public function PostTreatmentI(Request $request)
    {
        $Dat = Panen::with('PostTreatment', 'Kerik')
        // ->leftJoin('post_treatment_rebus', 'mylea_panen.id', '=', 'post_treatment_rebus.PanenID')
        //->whereRaw('Jumlah - (SELECT SUM(Jumlah) FROM post_treatment_details WHERE Panen_ID = mylea_panen.id) != 0')
        ->orderby('TanggalPanen', 'desc')
        ->get();

        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $Dat = Panen::with('PostTreatment', 'Kerik')
            ->whereBetween('TanggalPanen', [$Date1, $Date2])
            ->orderBy('TanggalPanen','desc')
            ->get();
        }
        
        if(isset($request->Submit)) {
            $search = $request->SearchQuery;
            $Dat = Panen::with('PostTreatment', 'Kerik')
            ->where('KPMylea', 'like', "%" . $search . "%")
            ->orderBy('TanggalPanen', 'desc')
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

            $data['Rebus'] = PTRebus::where('PanenID', $data['id'])->get();
            $data['TotalRebus']= $data['Rebus']->sum('JumlahRebus');
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

        // $totalJumlah = 0;
        $totalRejectBeforeKerik = 0;
        $totalHasilKerik = 0;
        $totalRejectKerik = 0;
        $totalStokBelumDikerik = 0;
        $totalRebus = 0;
        $totalBelumRebus = 0;
 

        foreach ($filteredData as $data) {
            // $totalJumlah += $data['Jumlah'];
            $totalRejectBeforeKerik += $data['Kerik']->sum('RejectBeforeKerik');
            $totalHasilKerik += $data['Kerik']->sum('Jumlah');
            $totalRejectKerik += $data['Kerik']->sum('RejectAfterKerik');
            $totalStokBelumDikerik += $data['Jumlah']-$data['kerik']->sum('Jumlah')-$data['kerik']->sum('RejectBeforeKerik')-$data['kerik']->sum('RejectAfterKerik');
            $totalRebus += $data['TotalRebus'];
            $totalBelumRebus += $data['Kerik']->sum('Jumlah') - $data['TotalRebus'];
        }


        return view('admin.PostTreatment.PostTreatmentI', [
            'Data' => $Dat,
            'Trial'=>$filteredData,
            'PTData' => $PTData,
            'Total'=>$Total,
            'TotalSudahKerik'=>$TotalSudahKerik,
            'TotalHasilKerik'=>$totalHasilKerik,
            'TotalPTProses'=>$TotalPTProses,
            'TotalRejectBeforeKerik'=> $totalRejectBeforeKerik,
            'TotalRejectKerik'=> $totalRejectKerik,
            'TotalBelumKerik'=> $totalStokBelumDikerik,
            'TotalRebus'=> $totalRebus,
            'TotalBelumRebus'=> $totalBelumRebus,
            // 'TotalSisaBelumTerpakai'=> $totalSisaBelumTerpakai,
        ]);
    }

    public function PostTreatmentII(Request $request) {

        $Data = PostTreatment::orderBy('Tanggal', 'desc')->where('Status', null)->paginate(80);
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
        // $PostTreatment = PTProses::all();

        //Data untuk pilihan di form awal post treatment
        
        $Dat = Panen::with('PostTreatment', 'Rebus')
        //->whereRaw('Jumlah - (SELECT SUM(Jumlah) FROM post_treatment_details WHERE Panen_ID = mylea_panen.id) != 0')
        ->orderby('TanggalPanen', 'desc')
        ->get();

        $filteredData = [];

        foreach($Dat as $data){
            $TotalPT = $data['PostTreatment']->sum('Jumlah');
            // $TotalRejectKerik = $data['Kerik']->sum('RejectBeforeKerik') + $data['Kerik']->sum('RejectAfterKerik');
            foreach($data['PostTreatment'] as $item){
                $item['Details'] = PostTreatment::where('id', $item['PT_ID'])->get()->first();
            }

            if(($data['Rebus']->sum('JumlahRebus') - $TotalPT) > 0){
                $data['InStock'] = $data['Rebus']->sum('JumlahRebus') - $TotalPT;
                $filteredData[] = $data;
            }
        }
        return view('admin.PostTreatment.PostTreatmentII', [
            'Data'=>$Data,
            // 'PTData'=>$PostTreatment,
            'FormData'=>$filteredData,
        ]);
    }
    public function PostTreatmentIII(Request $request) {

        $Data = PostTreatment::orderBy('Tanggal', 'desc')->where('Status', null)->paginate(80);
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
        // $PostTreatment = PTProses::all();

        //Data untuk pilihan di form awal post treatment
        
        $Dat = Panen::with('PostTreatment', 'Rebus')
        //->whereRaw('Jumlah - (SELECT SUM(Jumlah) FROM post_treatment_details WHERE Panen_ID = mylea_panen.id) != 0')
        ->orderby('TanggalPanen', 'desc')
        ->get();

        $filteredData = [];

        foreach($Dat as $data){
            $TotalPT = $data['PostTreatment']->sum('Jumlah');
            // $TotalRejectKerik = $data['Kerik']->sum('RejectBeforeKerik') + $data['Kerik']->sum('RejectAfterKerik');
            foreach($data['PostTreatment'] as $item){
                $item['Details'] = PostTreatment::where('id', $item['PT_ID'])->get()->first();
            }

            if(($data['Rebus']->sum('JumlahRebus') - $TotalPT) > 0){
                $data['InStock'] = $data['Rebus']->sum('JumlahRebus') - $TotalPT;
                $filteredData[] = $data;
            }
        }
        return view('admin.PostTreatment.PostTreatmentIII', [
            'Data'=>$Data,
            // 'PTData'=>$PostTreatment,
            'FormData'=>$filteredData,
        ]);
    }

    public function KerikSubmit(Request $request)
    {
        PTKerik::create([
            'PanenID'=> $request['PanenID'],
            'Tanggal'=> $request['Tanggal'],
            'Jumlah'=> $request['Jumlah'],
            'RejectBeforeKerik'=> $request['RejectBeforeKerik'],
            'RejectAfterKerik'=> $request['RejectAfterKerik'],
        ]);
        return redirect()->back()->with('message', 'Data Kerik Added');
    }

    public function KerikDelete($ID)
    {
        PTKerik::find($ID)->delete();
        return redirect()->back()->with('message2', 'Data Kerik Deleted');
    }

    public function Report(Request $request){
        $PostTreatment =  PostTreatment::orderBy('Tanggal', 'asc')
        ->select([
            "post_treatment.id as PostID",
            "post_treatment.Batch as Batch",
            "post_treatment.Tanggal as Tanggal",
            "post_treatment.Jumlah as JumlahAwal",
            "post_treatment_details.*",
            "mylea_panen.TanggalPanen as Tanggal Panen",
        ])
        ->leftjoin('post_treatment_details', 'post_treatment_details.PT_ID', '=', 'post_treatment.id')
        ->leftjoin('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
        ->paginate(80);

        $resume = array();
        if(isset($request->Submit)){
            $search = $request->SearchQuery;
            $PostTreatment =  PostTreatment::orderBy('Tanggal', 'desc')
            ->select([
                "post_treatment.id as PostID",
                "post_treatment.Batch as Batch",
                "post_treatment.Tanggal as Tanggal",
                "post_treatment.Jumlah as JumlahAwal",
                "post_treatment_details.*",
                "mylea_panen.TanggalPanen as Tanggal Panen",
            ])
            ->leftjoin('post_treatment_details', 'post_treatment_details.PT_ID', '=', 'post_treatment.id')
            ->leftjoin('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
            ->where('Batch','like',"%".$search."%")
            ->paginate(80);
        }
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));

            $PostTreatment =  PostTreatment::orderBy('Tanggal', 'desc')
            ->select([
                "post_treatment.id as PostID",
                "post_treatment.Batch as Batch",
                "post_treatment.Tanggal as Tanggal",
                "post_treatment.Jumlah as JumlahAwal",
                "post_treatment_details.*",
                "mylea_panen.TanggalPanen as Tanggal Panen",
            ])
            ->leftjoin('post_treatment_details', 'post_treatment_details.PT_ID', '=', 'post_treatment.id')
            ->leftjoin('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')
            ->whereBetween('TanggalPanen', [$Date1, $Date2])
            ->paginate(80);
            $resume['TanggalAwal'] = $Date1;
            $resume['TanggalAkhir'] = $Date2;
        }

        foreach($PostTreatment as $data){
            $data['Proses'] = PTProses::where('PT_ID', $data['PostID'])->get();
            $data['Mylea'] = PostTreatmentDetails::where('PT_ID', $data['PostID'])
                ->leftjoin('mylea_panen', 'mylea_panen.id', '=', 'post_treatment_details.Panen_ID')->get();
        }
        return view('admin.PostTreatment.Report', [
            'Data' => $PostTreatment,
            'Resume'=>$resume,
        ]);
    }


    public function DeleteAll($ID)
    {
        PostTreatment::where('id', $ID)->delete();
        PostTreatmentDetails::where('PT_ID')->delete();
        PTProses::where('PT_ID', $ID)->delete();
        return redirect()->back()->with('message2', 'Data Deleted');
    }

    public function RebusSubmit(Request $request)
    {
        PTRebus::create([
            'PanenID'=> $request['PanenID'],
            'Tanggal'=> $request['Tanggal'],
            'JumlahRebus'=> $request['Jumlah'],
        ]);
        return redirect()->back()->with('message', 'Data Rebus Added');
    }

    public function RebusDelete($ID)
    {
        PTRebus::find($ID)->delete();
        return redirect()->back()->with('message2', 'Data Kerik Deleted');
    }
}
