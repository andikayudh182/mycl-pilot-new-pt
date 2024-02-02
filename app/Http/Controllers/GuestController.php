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

    public function chart() {
        
        return view ('guest.chart');
    }
}
