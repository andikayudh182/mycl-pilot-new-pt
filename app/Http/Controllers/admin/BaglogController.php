<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Crushing;
use App\Models\Baglog\Resep;
use App\Models\Baglog\Mixing;
use App\Models\Baglog\Sterilisasi;
use App\Models\Baglog\PemakaianSterilisasi;
use App\Models\Baglog\Pengayakan;
use App\Models\Baglog\Pembibitan;
use App\Models\Baglog\Kontaminasi;
use App\Models\Mylea\BaglogMylea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class BaglogController extends Controller
{
    public function DataRecipe(){
        $resep = Resep::all()->where('Status', '=', '0');

        return view ('admin.Baglog.DataRecipe', ['resep'=>$resep,]);
    }

    public function ApproveResep($id){
        $update = Resep::find($id);

        if($update){
            $update->Approval = '1';
            $update->save();
        }
        $resep = Resep::all()->where('Status', '=', '0');
        return view ('admin.Baglog.DataRecipe', ['resep'=>$resep,]);
    }

    public function Report(Request $request){
        $data = Pembibitan::sortable()->orderBy('StatusArchive', 'asc')
        ->orderBy('TanggalPengerjaan','desc')
        ->paginate(80);
        $resume = array();
        if(isset($request->Submit)){
            $search = $request->SearchQuery;
            $data = Pembibitan::sortable()
            ->where('KodeProduksi','like',"%".$search."%")
            ->orderBy('StatusArchive', 'asc')
            ->orderBy('TanggalPengerjaan','desc')
            ->paginate(80);
        }
        if(isset($request->Filter)){
            $Date1 = date('Y-m-d', strtotime($request['TanggalAwal']));
            $Date2 = date('Y-m-d', strtotime($request['TanggalAkhir']));
            $data = Pembibitan::sortable()
            ->whereBetween('TanggalPengerjaan', [$Date1, $Date2])
            ->orderBy('TanggalPengerjaan','desc')
            ->paginate(80);
            $resume['TanggalAwal'] = $Date1;
            $resume['TanggalAkhir'] = $Date2;
            $resume['TotalProduksi'] = Pembibitan::select('JumlahBaglog')
            ->whereBetween('TanggalPengerjaan', [$Date1, $Date2])->get();
            $resume['Kontaminasi'] =Pembibitan::select([
                'baglog_pembibitan.KodeProduksi',
                'baglog_kontaminasi.JumlahKonta'
            ])
            ->whereBetween('TanggalPengerjaan', [$Date1, $Date2])
            ->join('baglog_kontaminasi', 'baglog_pembibitan.KodeProduksi', '=', 'baglog_kontaminasi.KodeProduksi')
            ->orderBy('TanggalPengerjaan','desc')
            ->get();
        }
        $konta = Kontaminasi::all()->groupBy('KodeProduksi');
        $TotalInStock = 0;
        foreach($data as $dt){
            $konta = Kontaminasi::where('KodeProduksi', $dt['KodeProduksi'])->get();
            $crushing = Crushing::where('KodeProduksi', $dt['KodeProduksi'])->get();

            $dt['Sterilisasi'] = explode(",", $dt['sterilisasi_id']);
            $dt['Sterilisasi'] = array_filter( $dt['Sterilisasi']);   
            
            $dt['Crushing']=$crushing;
            $dt['Kontaminasi'] = $konta;
            $dt['PersenKonta'] = $dt['Kontaminasi']->sum('JumlahKonta')/$dt['JumlahBaglog']*100;
            $dt['PersenKonta'] = round($dt['PersenKonta']);

            $startDate = new \DateTime($dt['BatchBibitTerpakai']);
            $endDate = new \DateTime($dt['TanggalPengerjaan']);

            $diff = $endDate->diff($startDate);
            $dt['UmurBibit']= floor($diff->days / 7);

            if($dt['StatusArchive'] == 1){
                $dt['StatusArchiveLabel'] = "Archived";
            } else {
                $dt['StatusArchiveLabel'] = "Active";
                $dt['StatusArchive'] = 0;
            }
            
            $dt['mylea'] = BaglogMylea::where('KPBaglog', $dt['KodeProduksi'])->get();
            $dt['InStock'] = $dt['JumlahBaglog'] - $dt['Kontaminasi']->sum('JumlahKonta') -$dt['mylea']->sum('JumlahBaglog');
            $dt['DataSterilisasi'] = PemakaianSterilisasi::where('PembibitanID', $dt['id'])
                                    ->join('baglog_sterilisasi', 'baglog_pemakaian_sterilisasi.SterilisasiID', 'baglog_sterilisasi.id')
                                    ->select('baglog_pemakaian_sterilisasi.Jumlah', 'baglog_sterilisasi.TanggalPengerjaan', 'baglog_sterilisasi.Batch')->get();
            $TotalInStock = $TotalInStock +$dt['InStock'];
        }

        return view('admin.Baglog.Report', [
            'data'=>$data,
            'konta'=>$konta,
            'TotalInStock'=>$TotalInStock,
            'Resume'=>$resume,
        ]);
    }

    public function ReportDetails($KodeProduksi){
        $data = Pembibitan::where('KodeProduksi', $KodeProduksi)->get();
        foreach($data as $dt){
            $dt['TanggalPengerjaanDT'] = date('Y-m-d',strtotime($dt['TanggalPengerjaan']));
            $dt['BatchBibitTerpakaiDT'] = date('Y-m-d',strtotime($dt['BatchBibitTerpakai']));
            $dt['BatchBibitDibuangDT'] = date('Y-m-d',strtotime($dt['BatchBibitDibuang']));
            
            if($dt['StatusArchive'] == 1){
                $dt['StatusArchiveLabel'] = "Archived";
            } else {
                $dt['StatusArchiveLabel'] = "Active";
            }
        }
        
        return view('admin.Baglog.Details', [
            'data'=>$data,
        ]);
    }

    public function ReportDetailsSubmit(Request $request){
        $pembibitan = $request->validate([
            'TanggalPengerjaan'=>'Required',
            'Batch'=> 'Required',
            'JumlahBaglog'=>'Required',
            'Kondisi'=>'Required',
            'BibitTerpakai'=>'Required',
            'BatchBibitTerpakai'=>'Required',
            'BibitReject'=>'Required',
        ]);

        Pembibitan::where('id', $request['id'])->update([
            'TanggalPengerjaan'=>$pembibitan['TanggalPengerjaan'],
            'Batch'=> $pembibitan['Batch'],
            'JumlahBaglog'=>$pembibitan['JumlahBaglog'],
            'Kondisi'=>$pembibitan['Kondisi'],
            'BibitTerpakai'=>$pembibitan['BibitTerpakai'],
            'BatchBibitTerpakai'=>$pembibitan['BatchBibitTerpakai'],
            'BibitReject'=>$pembibitan['BibitReject'],
            'BatchBibitDibuang'=>$request['BatchBibitDibuang'],
            'StatusArchive'=>$request['StatusArchive'],
        ]);
        $url = "/admin/baglog/report-details/".$request['KodeProduksi'];
        return redirect(url($url))->with('message', 'Data Updated');
    }

    public function DeletePembibitan($id){
        $delete = Pembibitan::where('id', '=', $id)->get();
        Sterilisasi::where('pembibitan_kp', $delete[0]['KodeProduksi'])->update([
            'pembibitan_kp' => NULL,
        ]);
        Pembibitan::where('id', '=', $id)->delete();

        $data = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->paginate(15);
        $konta = Kontaminasi::all()->groupBy('KodeProduksi');
        return redirect(url('/admin/baglog/report'));
    }

    public function konta($KodeProduksi){
        $Konta = Kontaminasi::all()->where('KodeProduksi', '=', $KodeProduksi);
        $user = User::all();
        return view('admin.Baglog.Kontaminasi',[
            'Konta'=>$Konta,
            'user'=>$user,
        ]);
    }

    public function UpdateKonta(Request $request){
        $id = $request['id'];
        Kontaminasi::find($id)->update([
            'KodeProduksi'=>$request['KodeProduksi'],
            'NoBibit'=>$request['NoBibit'],
            'JumlahKonta'=>$request['JumlahKonta'],
            'TanggalKonta'=> $request['TanggalKonta'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect(url('/admin/baglog/report', ['KodeProduksi'=> $request['KodeProduksi'],]))->with('message', 'Data Telah Di Update!');
    }

    public function deletekonta($id){
        Kontaminasi::where('id', '=', $id)->delete();

        $data = Pembibitan::orderBy('TanggalPengerjaan', 'desc')->paginate(15);
        $konta = Kontaminasi::all()->groupBy('KodeProduksi');
        $JumlahKonta = '0';
        return redirect(url('/admin/baglog/report'))->with('message', 'Data Telah Dihapus!');
    }

    public function Pengayakan(){
        $data = Pengayakan::orderBy('TanggalPengerjaan', 'desc')->paginate(80);
        $user = User::all();

        return view('admin.Baglog.Pengayakan',[
            'data'=>$data,
            'user'=>$user,
        ]);
    }

    public function DeletePengayakan($id){
        Pengayakan::where('id', '=', $id)->delete();

        $data = Pengayakan::orderBy('TanggalPengerjaan')->paginate(15);
        $user = User::all();

        return view('admin.Baglog.Pengayakan',[
            'data'=>$data,
            'user'=>$user,
        ]);
    }

    public function Mixing(){
        $data = Mixing::sortable()->paginate(80);
        $user = User::all();
        $resep = Resep::all();

        return view('admin.Baglog.Mixing',[
            'data'=> $data,
            compact('data'),
            'resep'=>$resep,
            'user'=>$user,
        ]);
    }

    public function DeleteMixing($id){
        Mixing::where('id', '=', $id)->delete();

        $data = Mixing::orderBy('TanggalPengerjaan')->paginate(15);
        $user = User::all();
        $resep = Resep::all();

        return redirect(url('/admin/baglog/report-mixing'))->with('message', 'Data Telah Dihapus');
    }

    public function UpdateMixing(Request $request){
        $id = $request['id'];
        Mixing::find($id)->update([
            'TanggalPengerjaan'=>$request['TanggalPengerjaan'],
            'Batch'=>$request['Batch'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'MCBaglog'=>$request['MCBaglog'],
            'MCBaglogAkhir'=>$request['MCBaglogAkhir'],
        ]);
        return redirect(url('/admin/baglog/report-mixing'))->with('message', 'Data Telah Di Update!');
    }

    public function Sterilisasi(){
        $data = Sterilisasi::sortable()->orderBy('TanggalPengerjaan', 'desc')->orderBy('Batch')->paginate(80);
        $user = User::all();

        return view('admin.Baglog.Sterilisasi',[
            'data'=>$data,
            'user'=>$user,
        ]);
    }
    
    public function DeleteSterilisasi($id){
        Sterilisasi::where('id', '=', $id)->delete();

        $data = Sterilisasi::orderBy('TanggalPengerjaan')->paginate(15);
        $user = User::all();

        return redirect(url('/admin/baglog/report-sterilisasi'))->with('message', 'Data Telah Dihapus');
    }

    public function UpdateSterilisasi(Request $request){
        $id = $request['id'];
        Sterilisasi::find($id)->update([
            'TanggalPengerjaan'=>$request['TanggalPengerjaan'],
            'Batch'=>$request['Batch'],
            'NoAutoclave'=>$request['NoAutoclave'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'Kondisi'=>$request['Kondisi'],
            'JumlahBaglogBerlubang'=>$request['JumlahBaglogBerlubang'],
            'JumlahTapeTidakHitam'=>$request['JumlahTapeTidakHitam'],
        ]);
        return redirect(url('/admin/baglog/report-sterilisasi'))->with('message', 'Data Telah Di Update!');
    }

    public function UpdateCrushing(Request $request){
        $id = $request['id'];
        Crushing::find($id)->update([
            'KodeProduksi'=>$request['KodeProduksi'],
            'TanggalCrushing'=>$request['TanggalCrushing'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'KondisiBaglog'=>$request['KondisiBaglog'],
            'JumlahBaglogPutih'=>$request['JumlahBaglogPutih'],
            'JumlahBaglogTidakTumbuh'=>$request['JumlahBaglogTidakTumbuh'],
            'JumlahBaglogTidakMerata'=>$request['JumlahBaglogTidakMerata'],
            'TotalBaglog'=>$request['TotalBaglog'],
        ]);
        return redirect(url('/admin/baglog/report'))->with('message', 'Data Telah Di Update!');
    }

    public function InkubasiBaglog(){
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        $kontaminasi = Kontaminasi::all()->groupBy('KodeProduksi');
        return view ('admin.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan, 'Kontaminasi'=>$kontaminasi,]);
    }

    public function InkubasiBaglogKonta($id){
        $konta = Pembibitan::find($id);
        return view ('admin.Baglog.InkubasiKonta', ['Konta'=>$konta,]);
    }

    public function InkubasiBaglogKontaSubmit(Request $request){
        $data = $request->validate([
            'KodeProduksi',
            'NoBibit',
            'JumlahKonta'=>'Required',
            'TanggalKonta'=>'Required',
            'Keterangan'
        ]);

        $user_id = Auth::user()->id;

        Kontaminasi::create([
            'KodeProduksi'=>$request['KodeProduksi'],
            'NoBibit'=>$request['NoBibit'],
            'JumlahKonta'=>$request['JumlahKonta'],
            'TanggalKonta'=> $request['TanggalKonta'],
            'Keterangan'=>$request['Keterangan'],
            'user_id'=>$user_id,
        ]);

        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        $kontaminasi = Kontaminasi::all()->groupBy('KodeProduksi');
        return view ('admin.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan, 'Kontaminasi'=>$kontaminasi,]);
    }

    public function InkubasiBaglogCrushing($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusCrushing = '1';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return view ('admin.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan,]);
    }

    public function InkubasiBaglogCrushingUndo($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusCrushing = '0';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return view ('admin.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan,]);
    }

    public function InkubasiBaglogPanen($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusPanen = '1';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return view ('admin.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan,]);
    }
}
