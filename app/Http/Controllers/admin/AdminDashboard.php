<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pembibitan = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->get();
        $konta = Kontaminasi::orderBy('TanggalKonta', 'desc')->get();
        return view('admin.dashboard', [
            'pembibitan'=>$pembibitan,
            'konta'=>$konta,
        ]);
    }

    public function DashboardProduction(Request $request)
    {
        $date = Carbon::now();
        $date->toDateString();
        $Baglog = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->whereYear('TanggalPengerjaan', $date)->get();
        foreach($Baglog as $Data){
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $Kontaminasi->sum('JumlahKonta');
            $Data['TanggalPengerjaan'] = substr($Data['TanggalPengerjaan'], 5, 2);
        }

        $Mylea = Produksi::orderBy('TanggalProduksi', 'desc')->whereYear('TanggalProduksi', $date)->get();
        foreach($Mylea as $Data){
            $Kontaminasi = Kontaminasi::where('KodeProduksi', $Data['KodeProduksi'])->get();
            $Data['JumlahKonta'] = $Kontaminasi->sum('JumlahKonta');
            $Panen = Panen::where('KPMylea', $Data['KodeProduksi'])->get();
            $Data['JumlahPanen'] = $Panen->sum('Jumlah');

            $Panen = new MyleaData();
            $Data['TanggalPanen'] = $Panen->GetTanggalPanen($Data);
            $Data['TanggalProduksi'] = substr($Data['TanggalProduksi'], 5, 2);

        }

        $TargetBaglog = DashboardQuaterTarget::where('Title', 'Baglog')->first();
        $TargetMylea = DashboardQuaterTarget::where('Title', 'Mylea')->first();

        return view('admin.Dashboard.ProductionReview', [
            'Baglog'=>$Baglog,
            'Mylea'=>$Mylea,
            'TargetBaglog'=>$TargetBaglog,
            'TargetMylea'=>$TargetMylea,
            'TodayDate'=>$date,
        ]);
    }

    public function DashboardProductionTargetChanged(Request $request)
    {
        $TargetBaglog = DashboardQuaterTarget::where('Title', 'Baglog')->update([
            'Q1'=> $request['BaglogQ1'],
            'Q2'=> $request['BaglogQ2'],
            'Q3'=> $request['BaglogQ3'],
            'Q4'=> $request['BaglogQ4'],
            'MaxCapacity'=> $request['BaglogMaxCapacity']
        ]);
        $TargetMylea = DashboardQuaterTarget::where('Title', 'Mylea')->update([
            'Q1'=> $request['MyleaQ1'],
            'Q2'=> $request['MyleaQ2'],
            'Q3'=> $request['MyleaQ3'],
            'Q4'=> $request['MyleaQ4'],
            'MaxCapacity'=> $request['MyleaMaxCapacity']
        ]);
        return redirect()->back()->with('message', 'Data Target Updated!');
    }


    public function baglog()
    {
        $date = Carbon::now();
        $date->toDateString();
        $pembibitan = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->whereMonth('TanggalPanen', $date)->get();
        $konta = Kontaminasi::orderBy('TanggalKonta', 'asc')->get();
        $ProduksiBaglog = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->whereYear('TanggalPanen', $date)->get();
        if(isset($ProduksiBaglog)){
            foreach($ProduksiBaglog as $Data){
                $Kontaminasi = Kontaminasi::where('KodeProduksi', $Data['KodeProduksi'])->get();
                $Data['JumlahKonta'] = 0;
                foreach($Kontaminasi as $DataKonta){
                    $Data['JumlahKonta'] = $Data['JumlahKonta'] + $DataKonta['JumlahKonta'];
                }
            }
            $DataPoint = array();
            $DataPoint2 = array();
            $Data = array();
            for($i = 1; $i < 13; $i++){
                $produksi = 0;
                $kontaminasi = 0;
                $j = 0;

                foreach($ProduksiBaglog as $data){
                    $TanggalPengerjaan = $data['TanggalPengerjaan'];
                    $Kontaminasi = Kontaminasi::where('KodeProduksi', $data['KodeProduksi'])->get();
                    $data['JumlahKonta'] = 0;
                    foreach($Kontaminasi as $DataKonta){
                        $data['JumlahKonta'] = $data['JumlahKonta'] + $DataKonta['JumlahKonta'];
                    }
                    if(substr($TanggalPengerjaan, 5, 2) == $i){
                        $Data[$i][$j] = $data;
                        $produksi = $produksi + $data['JumlahBaglog'];
                        $kontaminasi = $kontaminasi + $data['JumlahKonta'];
                        $j++;
                    }

                }
                $DataPoint[$i] = $produksi; 
                $DataPoint2[$i] = $kontaminasi;
                if(!($produksi == 0)){
                    $DataPoint3[$i]= round($kontaminasi/$produksi*100, 2);
                } else{
                    $DataPoint3[$i]= 0;
                }

            }

        }

        return view('admin.BaglogIndex', [
            'pembibitan'=>$pembibitan,
            'konta'=>$konta,
            'DataPoint'=>$DataPoint,
            'DataPoint2'=>$DataPoint2,
            'DataPoint3'=>$DataPoint3,
            'Data'=>$Data,
        ]);
    }

    public function mylea()
    {
        return view('admin.MyleaIndex', [

        ]);
    }
}
