<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Pembibitan;
use App\Models\Mylea\Produksi;
use App\Models\Mylea\BaglogMylea;
use App\Models\Mylea\Elus;
use App\Models\Mylea\Kontaminasi;
use App\Models\Mylea\Panen;
use App\Models\Mylea\PanenDetails;
use App\Models\Baglog\BaglogRnD;
use App\Http\Controllers\admin\busslogic\SortFilter;
use App\Http\Controllers\admin\busslogic\MyleaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class MyleaController extends Controller
{
    public function Dashboard(){
        $date = Carbon::now();
        $date->toDateString();
        $ProduksiMylea = Produksi::orderBy('TanggalProduksi', 'asc')->whereYear('TanggalProduksi', $date)->get();
        Carbon::now()->month;

        // $ProduksiMyleaDirect 
        $ProduksiMyleaDirect = Produksi::orderBy('TanggalProduksi', 'asc')
        ->whereYear('TanggalProduksi', $date)
        ->where(function($query) {
            $query->whereRaw('LOWER(KodeProduksi) LIKE ?', ['%d%'])
                ->orWhereRaw('LOWER(Keterangan) LIKE ?', ['%direct%']);
        })
        ->get();

        if(isset($ProduksiMylea)){
            $DataPoint = array();
            $DataPoint2 = array();
            $DataPoint3 = array();
            $DataPoint4 = array();
            $DataMarker = array();
         

            $DataPointDirect = array();
            $DataPointDirect2 = array();
            $DataPointDirect3 = array();
            $DataMarkerDirect = array();

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

                    $Konta = Kontaminasi::where('KPMylea', $data['KodeProduksi'])->get();
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
            // Direct Transfer
            for($i = 1; $i < 13; $i++){
                $produksiDirect = 0;
                $panenDirect = 0;
                $kontaDirect = 0;
                foreach($ProduksiMyleaDirect as $data){
                    $TanggalPengerjaanDirect = $data['TanggalProduksi'];
                    $PanenDirect = Panen::where('KPMylea', $data['KodeProduksi'])->get();
                    $data['JumlahPanen'] = $PanenDirect->sum('Jumlah');
                    $KontaDirect = Kontaminasi::where('KPMylea', $data['KodeProduksi'])->get();
                    $data['JumlahKonta'] = $KontaDirect->sum('Jumlah');
                    if(substr($TanggalPengerjaanDirect, 5, 2) == $i){
                        $produksiDirect = $produksiDirect + $data['Jumlah'];
                        $panenDirect = $panenDirect + $data['JumlahPanen'];
                        $kontaDirect = $kontaDirect + $data['JumlahKonta'];

                        $JadwalPanen = $Mylea->GetTanggalPanen($data);
                    }

                }
                $DataPointDirect[$i] = $produksiDirect; 
                $DataPointDirect2[$i] = $panenDirect;
                if(!($produksiDirect == 0)){
                    if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)) {
                        $DataPointDirect3[$i]= round($panenDirect/$produksiDirect*100, 2);
                    } else {
                        $DataPointDirect3[$i]= round(($produksiDirect - $kontaDirect)/$produksiDirect*100, 2);
                    }
                    $DataPointDirect4[$i] = $produksiDirect - $kontaDirect - $panenDirect;
                } else {
                    $DataPointDirect3[$i]= 0;
                    $DataPointDirect4[$i]= 0;
                }

                if(substr($JadwalPanen, 5, 2) < substr($date, 5, 2)){
                    $DataMarkerDirect[$i] = "#23BFAA";
                } else {
                    $DataMarkerDirect[$i] = "red";
                }
            }

        }
        return view('admin.MyleaIndex', [
            'DataPoint'=>$DataPoint,
            'DataPoint2'=>$DataPoint2,
            'DataPoint3'=>$DataPoint3,
            'DataPoint4'=>$DataPoint4,
            'DataMarker'=> $DataMarker,

            'DataPointDirect'=>$DataPointDirect,
            'DataPointDirect2'=>$DataPointDirect2,
            'DataPointDirect3'=>$DataPointDirect3,
            'DataPointDirect4'=>$DataPointDirect4,
            'DataMarkerDirect'=> $DataMarkerDirect,
        ]);
    }

    public function Report(Request $request){
        $Mylea = Produksi::sortable()->orderBy('TanggalProduksi','desc')->get();
        $MyleaAll = Produksi::sortable()->orderBy('TanggalProduksi','desc')->get();
        $resume = array();
        
        if (isset($request['TanggalAwal'])) {
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']."+0 day"));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']. "+0 day"));
            
            $query = Produksi::sortable()
                ->whereBetween('TanggalProduksi', [$Date1, $Date2]);
        
            if (isset($request->Keterangan)) {
                $search2 = $request->Keterangan;
                $query->where('Keterangan', 'like', "%" . $search2 . "%");
            }
        
            // Cek apakah KodeProduksi tidak kosong sebelum menambahkannya ke dalam query
            if (isset($request->KodeProduksi)) {
                $search = $request->KodeProduksi;
                $query->where('KodeProduksi', 'like', "%" . $search . "%");
            }
        
            $Mylea = $query->orderBy('TanggalProduksi', 'desc')->get();
            $MyleaAll = $query->orderBy('TanggalProduksi', 'desc')->get();
        }
        
        
        foreach($Mylea as $data){
            $data['DataKontaminasi'] = Kontaminasi::where('KPMylea', $data['KodeProduksi'])->get();
            $data['Panen']= Panen::where('KPMylea', $data['KodeProduksi'])->get();
            $data['PanenBaglog'] = PanenDetails::select([
                'mylea_panen_details.*',
                'mylea_panen.TanggalPanen'
            ])
            ->join('mylea_panen', 'mylea_panen.id', '=', 'mylea_panen_details.PanenID')
            ->where('mylea_panen.KPMylea', $data['KodeProduksi'])->get();

            
            foreach($data['Panen'] as $Panen){
                $Panen['Baglog'] = PanenDetails::where('PanenID', $Panen['id'])->get();
                
            }
            $data['Konta'] = $data['DataKontaminasi']->sum('Jumlah');
            
            $selectTotalHarvest = DB::table('mylea_panen as m')
                ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
                ->where('m.KPMylea', $data['KodeProduksi'])
                ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
                ->first();

            $data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;
            $data['InStock'] = $data['Jumlah'] - $data['Konta'] - $data['JumlahPanen'];
            $data['PersenKonta'] = $data['Konta']/$data['Jumlah']*100;
            $Baglog = BaglogMylea::where('KPMylea', $data['KodeProduksi'])
            ->select([
                'mylea_baglog.id',
                'mylea_baglog.KPBaglog',
                'mylea_baglog.JumlahBaglog',
                'mylea_baglog.KondisiBaglog',
                'baglog_pembibitan.BatchBibitTerpakai',
                'baglog_pembibitan.TanggalPengerjaan',
                
            ])
            ->leftjoin('baglog_pembibitan', 'baglog_pembibitan.KodeProduksi', '=', 'mylea_baglog.KPBaglog')
            ->get();
            
            $data['Baglog'] = '';
            foreach($Baglog as $baglog){
                $data['Baglog'] = $data['Baglog'].$baglog['KPBaglog'].', ';
                $baglog['Type'] = DB::table('baglog_resep as br')
                                ->join('baglog_mixing as bm', 'bm.resep_id', '=', 'br.id')
                                ->join('baglog_sterilisasi as bs', 'bs.mixing_id', '=', 'bm.id')
                                ->join('baglog_pemakaian_sterilisasi as bps', 'bps.SterilisasiID', '=', 'bs.id')
                                ->join('baglog_pembibitan as bp', 'bp.id', '=', 'bps.PembibitanID')
                                ->where('bp.KodeProduksi',$baglog['KPBaglog'])
                                ->groupBy('br.Type')
                                ->pluck('br.Type');
                $baglog['Type'] = isset($baglog['Type'][0]) ? $baglog['Type'][0] : '';
            

                $startDate = new \DateTime($baglog['BatchBibitTerpakai']);
                $endDate = new \DateTime($baglog['TanggalPengerjaan']);
    
                $diff = $endDate->diff($startDate);
                $baglog['UmurBibit']= floor($diff->days / 1);

                $startDate = strtotime($baglog['TanggalPengerjaan']);
                $endDate = strtotime($data['TanggalProduksi']);
                
                if ($startDate !== false && $endDate !== false) {
                    $difference = $endDate - $startDate;
                    $daysDifference = floor($difference / (60 * 60 * 24)); // Menghitung selisih hari
                    
                    $weeksDifference = floor($daysDifference / 7); // Menghitung selisih minggu
                    
                    $baglog['UmurBaglog'] = $weeksDifference;
                } else {
                    // Penanganan kesalahan jika format tanggal tidak valid
                    $baglog['UmurBaglog'] = $startDate ."-". $endDate;
                }
                
            }
            $data['DataBaglog'] = $Baglog;

            
            $data['DataElus'] = Elus::where('KPMylea', $data['KodeProduksi'])->get();

        }

        foreach ($MyleaAll as $datafull){
            $datafull['DataKontaminasi'] = Kontaminasi::where('KPMylea', $datafull['KodeProduksi'])->get();
            $datafull['Panen']= Panen::where('KPMylea', $datafull['KodeProduksi'])->get();
            $datafull['PanenBaglog'] = PanenDetails::select([
                'mylea_panen_details.*',
                'mylea_panen.TanggalPanen'
            ])
            ->join('mylea_panen', 'mylea_panen.id', '=', 'mylea_panen_details.PanenID')
            ->where('mylea_panen.KPMylea', $datafull['KodeProduksi'])->get();

            
            foreach($datafull['Panen'] as $Panen){
                $Panen['Baglog'] = PanenDetails::where('PanenID', $Panen['id'])->get();
                
            }
            $datafull['Konta'] = $datafull['DataKontaminasi']->sum('Jumlah');
            
            $selectTotalHarvest = DB::table('mylea_panen as m')
                ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
                ->where('m.KPMylea', $datafull['KodeProduksi'])
                ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
                ->first();

            $datafull['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;
            $datafull['InStock'] = $datafull['Jumlah'] - $datafull['Konta'] - $datafull['JumlahPanen'];
            $datafull['PersenKonta'] = $datafull['Konta']/$datafull['Jumlah']*100;
        }

        $Baglog = Pembibitan::where('StatusArchive', NULL)->where('StatusPanen', '1')->get();
        $BaglogRnD = BaglogRnD::where('StatusArchive', NULL)->orWhere('StatusArchive', '0')->get();

        $SortFilter =  new SortFilter();
        $Mylea = $SortFilter->Filter($Mylea, $request);
        $Mylea = $SortFilter->SortKonta($Mylea, $request['KontaDir']);
        $Mylea = $SortFilter->SortPanen($Mylea, $request['PanenDir']);
        $Mylea = $SortFilter->SortPersenKonta($Mylea, $request['PersenKontaDir']);
        $Mylea = $SortFilter->SortInStock($Mylea, $request['InStockDir']);
        // $Mylea = $Mylea->paginate(200);

        

        return view('admin.Mylea.Report', [
            'Data' => $Mylea,
            'DataAll' => $MyleaAll,
            'Resume'=>$resume,
            'DataBaglog'=> $Baglog,
            'BaglogRnD'=> $BaglogRnD,
        ]);
    }

    public function HarvestSchedule(){
        $date = Carbon::now();
        $date->toDateString();
        $MyleaDat = new MyleaData();
        $MyleaPanen = Produksi::orderBy('TanggalProduksi', 'asc')->whereYear('TanggalProduksi', $date)->get();
        Carbon::now()->month;

        foreach($MyleaPanen as $data){
            $data['JadwalPanen'] = $MyleaDat->GetTanggalPanen($data);

            $data['DataKontaminasi'] = Kontaminasi::select('Jumlah')->where('KPMylea', $data['KodeProduksi'])->get();
            $data['Panen']= Panen::select('Jumlah')->where('KPMylea', $data['KodeProduksi'])->get();
 
            $data['Konta'] = $data['DataKontaminasi']->sum('Jumlah');
            
            $selectTotalHarvest = DB::table('mylea_panen as m')
                                ->join('mylea_panen_details as mpd', 'm.id', '=', 'mpd.PanenID')
                                ->where('m.KPMylea', $data['KodeProduksi'])
                                ->select(DB::raw('SUM(mpd.Jumlah) as TotalHarvest'))
                                ->first();

            $data['JumlahPanen'] = $selectTotalHarvest->TotalHarvest;
            $data['InStock'] = $data['Jumlah'] - $data['Konta'] - $data['JumlahPanen'];
        }
        $TanggalPanen = Produksi::orderBy('TanggalProduksi', 'asc')->whereYear('TanggalProduksi', $date)->get();
        
        foreach($TanggalPanen as $data){
            $data['JadwalPanen'] = $MyleaDat->GetTanggalPanen($data);
            $data['JadwalPanen'] = substr($data['JadwalPanen'], 0, 7);
        }
        $TanggalPanen = $TanggalPanen->unique('JadwalPanen');
        return view('admin.Mylea.HarvestSchedule', [
            'MyleaPanen'=>$MyleaPanen,
            'TanggalPanen'=>$TanggalPanen,
        ]);
    }

    public function ProduksiEdit(Request $request){

        $Method = $request['Method'];
        $KodeProduksi = $request['KodeProduksi']; 
        $KodeProduksi2 = $request['KodeProduksi']; 

        $lastChar = substr($KodeProduksi, -1);
        if (stristr($Method, 'Direct') !== false) {
            if ($lastChar !== 'D'&& $lastChar !== 'N' ) {
                $KodeProduksi .= 'D';
            } else if ($lastChar === 'N') {
                $KodeProduksi = substr($KodeProduksi, 0, -1);
                $KodeProduksi .= 'D';
            }
            BaglogMylea::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Kontaminasi::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Elus::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Panen::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
       }

        if (empty($Method) || stristr($Method, 'Direct') === false) {
            if ($lastChar === 'D') {
                $KodeProduksi = substr($KodeProduksi, 0, -1);
                $KodeProduksi .= 'N';
            }
            BaglogMylea::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Kontaminasi::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Elus::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
            Panen::where('KPMylea', $KodeProduksi2)->update(['KPMylea' => $KodeProduksi]);
        }
    
        Produksi::find($request['id'])->Update([
            'KodeProduksi'=> $KodeProduksi,
            'TanggalProduksi'=>$request['TanggalProduksi'],
            'TanggalElus'=>$request['TanggalElus1'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Jumlah'=>$request['Jumlah'],
            'Keterangan'=>$request['Keterangan'],
            'Method'=>$Method,
            'Tray'=>$request['Tray'],
            'SubstrateQty'=>$request['SubstrateQty'],
        ]);

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Produksi Updated!');
    }

    public function ProduksiDelete($id, $KPMylea){
        $data = Produksi::where('id', '=', $id)->first();
        
        if ($data) {
            Pembibitan::whereIn('KodeProduksi', function ($query) use ($KPMylea) {
                $query->select('KPBaglog')
                    ->from(with(new BaglogMylea)->getTable())
                    ->where('KPMylea', $KPMylea);
            })
            ->update(['StatusArchive' => NULL]);

            BaglogMylea::where('KPMylea', $data->KodeProduksi)->delete();
            Panen::where('KPMylea', $data->KodeProduksi)->delete();
            Kontaminasi::where('KPMylea', $data->KodeProduksi)->delete();
            Elus::where('KPMylea', $data->KodeProduksi)->delete();
            Produksi::where('id', '=', $id)->delete();
    
            return redirect(url('/admin/mylea/report'))->with('message', 'Data Produksi Deleted!');
        } else {
            return redirect(url('/admin/mylea/report'))->with('message', 'Data not found.');
        }
    }

    public function FormKontaminasi($KodeProduksi){
        $Baglog = BaglogMylea::where('KPMylea', $KodeProduksi)->get();
        return view('admin.Mylea.FormKontaminasi', [
            'KodeProduksi'=>$KodeProduksi,
            'Baglog'=>$Baglog,
        ]);
    }

    public function KontaminasiSubmit(Request $request){
        $request->validate([
            'TanggalKontaminasi'=> 'Required',
        ]);

        $id = Auth::user()->id;

        foreach($request->data as $key => $value){
            Kontaminasi::create([
                'user_id'=>$id,
                'TanggalKontaminasi'=>$request['TanggalKontaminasi'],
                'KPMylea'=>$request['KPMylea'],
                'KPBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
                'NoBibit'=>$value['NoBibit'],
                'KondisiBaglog'=>$value['KondisiBaglog'],
                'Keterangan'=>$value['Keterangan'],
            ]);
        }

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Kontaminasi Added!');
    }

    public function DeleteKontaminasi($id){
        Kontaminasi::where('id', '=', $id)->delete();

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Kontaminasi Deleted!');
    }

    public function UpdatePanen(Request $request){
        $id = $request['id'];
        $panenDetailsID = $request['PanenDetailsID'];
        PanenDetails::where('id', '=', $panenDetailsID)->update([
            'Jumlah'=>$request['JumlahBaglog'],
        ]);

        $totalBaglog = PanenDetails::where('PanenID', $id)->sum('Jumlah');

        Panen::find($id)->update([
            'KPMylea'=>$request['KPMylea'],
            'TanggalPanen'=>$request['TanggalPanen'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Jumlah'=>$totalBaglog,
            'JenisPanen'=>$request['JenisPanen'],
        ]);

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Panen Submitted!');
    }

    public function DeletePanen($id){
        try {
            Panen::where('id', '=', $id)->delete();
            
            return redirect(url('/admin/mylea/report'))->with('message', 'Data Panen Deleted!');
        } catch (\Exception $e) {
            return redirect(url('/admin/mylea/report'))->with('error', 'An error occurred while deleting data.');
        }
    }
    

    public function FormElus($KodeProduksi){

        return view('admin.Mylea.FormElus', [
            'KodeProduksi'=>$KodeProduksi,
        ]);
    }

    public function DeleteElus($id){
        Elus::where('id', '=', $id)->delete();

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Elus Deleted!');
    }

    public function DeleteBaglog($id){
        BaglogMylea::where('id', '=', $id)->delete();

        return redirect()->back()->with('message', 'Data Baglog Deleted!');
    }

    public function ElusSubmit(Request $request){
        $request->validate([
            'TanggalElus'=> 'Required',
        ]);
        $id = Auth::user()->id;
        Elus::create([
            'user_id'=>$id,
            'TanggalElus'=>$request['TanggalElus'],
            'KPMylea'=>$request['KPMylea'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Jumlah'=>$request['Jumlah'],
        ]);

        return redirect(url('/admin/mylea/report'))->with('message', 'Data Elus Added!');
    }
    public function BaglogSubmit(Request $request){
        BaglogMylea::create([
            'KPMylea'=>$request['KodeProduksi'],
            'KPBaglog'=>$request['KodeBaglog'],
            'JumlahBaglog'=>$request['Jumlah'],
            'KondisiBaglog'=>$request['KondisiBaglog'],
        ]);

        $Jumlah = BaglogMylea::where('KPMylea', $request['KodeProduksi'])->get()->sum('Jumlah');
        Produksi::where('KodeProduksi', 'KPMylea')->update(['Jumlah'=>$Jumlah]);

        return redirect()->back()->with('message', 'Data Baglog Added!');
    }
}
