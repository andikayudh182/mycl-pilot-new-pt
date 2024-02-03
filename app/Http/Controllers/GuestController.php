<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Pembibitan;
use App\Models\Baglog\Kontaminasi;
use App\Models\Mylea\Produksi;
use App\Models\Mylea\Kontaminasi as KontaMylea; 
use App\Models\Mylea\Panen;
use App\Http\Controllers\admin\busslogic\MyleaData;
use App\Models\DashboardQuaterTarget;
use Carbon\Carbon;
use App\Models\baglog\Kartu_Kendali;
use App\Models\baglog\Mixing;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function dashboard(Request $request) {
        // for 2023
        $YearSetting = 2023;
        // if (isset($request->FilterYear)) {
        //     $YearSetting = $request['Year'];
        // }
        $date =  Carbon::now()->year($YearSetting);
        $date->toDateString();
        $Baglog = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->whereYear('TanggalPengerjaan', $date)->get();
        foreach($Baglog as $Data){
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $Kontaminasi->sum('JumlahKonta');
            $Data['TanggalPengerjaan'] = substr($Data['TanggalPengerjaan'], 5, 2);
        }

        $Mylea = Produksi::orderBy('TanggalProduksi', 'desc')->whereYear('TanggalProduksi', $date)->get();
        foreach($Mylea as $Data){
            $KontamMylea = KontaMylea::where('KPMylea', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $KontamMylea->sum('Jumlah');
            $Panen = Panen::where('KPMylea', $Data['KodeProduksi'])->get();
            // $Data['JumlahPanen'] = $Panen->sum('Jumlah');

            $selectTotalHarvest = DB::table('mylea_panen as m')
            ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
            ->where('m.KPMylea', $Data['KodeProduksi'])
            ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
            ->first();

            $Data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;

            $Panen = new MyleaData();
            $Data['TanggalPanen'] = $Panen->GetTanggalPanen($Data);
            $Data['TanggalProduksi'] = substr($Data['TanggalProduksi'], 5, 2);

        }
        // For 2024
        $YearSetting2024 = 2024;
        // if (isset($request->FilterYear)) {
        //     $YearSetting2024 = $request['Year'];
        // }
        $date2024 =  Carbon::now()->year($YearSetting2024);
        $date2024->toDateString();
        $Baglog2024 = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->whereYear('TanggalPengerjaan', $date2024)->get();
        foreach($Baglog2024 as $Data){
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $Kontaminasi->sum('JumlahKonta');
            $Data['TanggalPengerjaan'] = substr($Data['TanggalPengerjaan'], 5, 2);
        }

        $Mylea2024 = Produksi::orderBy('TanggalProduksi', 'desc')->whereYear('TanggalProduksi', $date2024)->get();
        foreach($Mylea2024 as $Data){
            $KontamMylea = KontaMylea::where('KPMylea', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $KontamMylea->sum('Jumlah');
            $Panen = Panen::where('KPMylea', $Data['KodeProduksi'])->get();
            // $Data2024['JumlahPanen'] = $Panen->sum('Jumlah');

            $selectTotalHarvest = DB::table('mylea_panen as m')
            ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
            ->where('m.KPMylea', $Data['KodeProduksi'])
            ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
            ->first();

            $Data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;

            $Panen= new MyleaData();
            $Data['TanggalPanen'] =$Panen->GetTanggalPanen($Data);
            $Data['TanggalProduksi'] = substr($Data['TanggalProduksi'], 5, 2);

        }



        $TargetBaglog = DashboardQuaterTarget::where('Title', 'Baglog')->first();
        $TargetMylea = DashboardQuaterTarget::where('Title', 'Mylea')->first();
        
        return view ('guest.dashboard',[
            'Baglog'=>$Baglog,
            'Mylea'=>$Mylea,
            'TargetBaglog'=>$TargetBaglog,
            'TargetMylea'=>$TargetMylea,
            'TodayDate'=>$date,
            'YearSetting'=>$YearSetting,

            'Baglog2024'=>$Baglog2024,
            'Mylea2024'=>$Mylea2024,
            'TodayDate2024'=>$date2024,
            'YearSetting2024'=>$YearSetting2024,
        ]);
    }

    public function chart(Request $request) {

        // For 2023
        $YearSetting = 2023;

        $date = Carbon::now()->year($YearSetting);
        $date->toDateString();
        $ProduksiMylea = Produksi::orderBy('TanggalProduksi', 'asc')->whereYear('TanggalProduksi', $date)->get();
        // Carbon::now()->month;


        if(isset($ProduksiMylea)){
            $DataPoint = array();
            $DataPoint2 = array();
            $DataPoint3 = array();
            $DataPoint4 = array();
            $DataMarker = array();
         

            $Mylea = new MyleaData();
            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $panen = 0;
                $konta = 0;
                $JadwalPanen = '';
         
                foreach($ProduksiMylea as $data){
                    $TanggalPengerjaan = $data['TanggalProduksi'];
                    $Panen = Panen::where('KPMylea', $data['KodeProduksi'])->get();
                    
                    $selectTotalHarvest = DB::table('mylea_panen as m')
                    ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
                    ->where('m.KPMylea', $data['KodeProduksi'])
                    ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
                    ->first();
    
                    $data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;

                    $Konta = KontaMylea::where('KPMylea', $data['KodeProduksi'])->get();
                    $data['JumlahKonta'] = $Konta->sum('Jumlah');
                   
                    if(substr($TanggalPengerjaan, 5, 2) == $i){
                        $produksi = $produksi + $data['Jumlah'];
                        $panen = $panen + $data['JumlahPanen'];
                        $konta = $konta + $data['JumlahKonta'];
                        $JadwalPanen = $Mylea->GetTanggalPanen($data);
                    }
                }
                $DataPoint[$i] = $produksi; 
                $DataPoint2[$i] = $panen;
                if(!($produksi == 0)){
                    //check data yang sudah final/belum (panen)
                    if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)) {
                        $DataPoint3[$i]= round($panen/$produksi*100, 2);
                    } else {
                        $DataPoint3[$i]= round(($produksi - $konta)/$produksi*100, 2);
                    }
                    
                    $DataPoint4[$i] = $produksi - $konta - $panen;
                
                } else {
                    $DataPoint3[$i]= 0;
                    $DataPoint4[$i]= 0;
                }

                if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)){
                    $DataMarker[$i] = "#23BFAA";
                } else {
                    $DataMarker[$i] = 'red';
                }
              

            }
            
        }
        // 2024
        $YearSetting2024 = 2024;

        $date2024 = Carbon::now()->year($YearSetting2024);
        $date2024->toDateString();
        $ProduksiMylea2024 = Produksi::orderBy('TanggalProduksi', 'asc')->whereYear('TanggalProduksi',$date2024)->get();

        if(isset($ProduksiMylea2024)){
            $DataPoint2024 = array();
            $DataPoint20242 = array();
            $DataPoint20243 = array();
            $DataPoint20244 = array();
            $DataMarker2024 = array();
         

           $Mylea2024= new MyleaData();
            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $panen = 0;
                $konta = 0;
                $JadwalPanen = '';
         
                foreach($ProduksiMylea2024 as $data){
                    $TanggalPengerjaan = $data['TanggalProduksi'];
                    $Panen = Panen::where('KPMylea', $data['KodeProduksi'])->get();
                    
                    $selectTotalHarvest = DB::table('mylea_panen as m')
                    ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
                    ->where('m.KPMylea', $data['KodeProduksi'])
                    ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
                    ->first();
    
                    $data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;

                    $Konta = KontaMylea::where('KPMylea', $data['KodeProduksi'])->get();
                    $data['JumlahKonta'] = $Konta->sum('Jumlah');
                   
                    if(substr($TanggalPengerjaan, 5, 2) == $i){
                        $produksi = $produksi + $data['Jumlah'];
                        $panen = $panen + $data['JumlahPanen'];
                        $konta = $konta + $data['JumlahKonta'];
                        $JadwalPanen = $Mylea2024->GetTanggalPanen($data);
                    }
                }
                $DataPoint2024[$i] = $produksi; 
                $DataPoint20242[$i] = $panen;
                if(!($produksi == 0)){
                    //check data yang sudah final/belum (panen)
                    if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)) {
                        $DataPoint20243[$i]= round($panen/$produksi*100, 2);
                    } else {
                        $DataPoint20243[$i]= round(($produksi - $konta)/$produksi*100, 2);
                    }
                    
                    $DataPoint20244[$i] = $produksi - $konta - $panen;
                
                } else {
                    $DataPoint20243[$i]= 0;
                    $DataPoint20244[$i]= 0;
                }

                if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)){
                    $DataMarker2024[$i] = "#23BFAA";
                } else {
                    $DataMarker2024[$i] = 'red';
                }
              

            }
            
        }

        


 
        
        return view ('guest.chart', [
            'DataPoint'=>$DataPoint,
            'DataPoint2'=>$DataPoint2,
            'DataPoint3'=>$DataPoint3,
            'DataPoint4'=>$DataPoint4,
            'DataMarker'=> $DataMarker,

            'DataPoint2024'=>$DataPoint2024,
            'DataPoint20242'=>$DataPoint20242,
            'DataPoint20243'=>$DataPoint20243,
            'DataPoint20244'=>$DataPoint20244,
            'DataMarker2024'=> $DataMarker2024,

            'YearSetting'=> $YearSetting,
            'YearSetting2024'=> $YearSetting2024,
        ]);
    }
 
}