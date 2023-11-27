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
use App\Models\Mylea\PanenDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyleaController extends Controller
{
    public function FormProduksi()
    {
        $Baglog = Pembibitan::where('StatusArchive', NULL)->where('StatusPanen', '1')->get();
        $BaglogRnD = BaglogRnD::where('StatusArchive', NULL)->orWhere('StatusArchive', '0')->get();
        return view('operator.Mylea.FormProduksi', ['Data'=>$Baglog, 'BaglogRnD'=>$BaglogRnD,]);
    }

    public function FormProduksiSubmit(Request $request)
    {
        $request->validate([
            'TanggalProduksi' => 'Required',
            'TanggalElus1' => 'Required',
            'JamMulai' => 'Required',
            'JamSelesai' =>'Required',
            'JumlahTray' =>'Required',
            'Method' =>'Required',
            'Tray' =>'Required',
        ]);

        $id = Auth::user()->id;
        $TanggalProduksi = $request['TanggalProduksi'];
        $Keterangan = $request['Keterangan'];
        $Method= $request['Method'];
        $KodeProduksi = '';
        $KodeProduksi =  "MYTP".$TanggalProduksi;

        if (stristr($Method, 'Direct') !== false) {
            $KodeProduksi .= 'D';
        }
        
        // $Jumlah = '0';

        foreach($request->data as $key => $value){
            BaglogMylea::create([
                'KPMylea'=>$KodeProduksi,
                'KPBaglog'=>$value['KodeBaglog'],
                'JumlahBaglog'=>$value['Jumlah'],
                'KondisiBaglog'=>$value['KondisiBaglog'],
            ]);
            // $Jumlah = $Jumlah + $value['Jumlah'];
        }

        Produksi::create([
            'user_id'=>$id,
            'KodeProduksi'=>$KodeProduksi,
            'TanggalProduksi'=>$TanggalProduksi,
            'TanggalElus'=>$request['TanggalElus1'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Keterangan'=>$Keterangan,
            'Jumlah'=>$request['JumlahTray'],
            'Method'=>$Method,
            'Tray'=>$request['Tray'],
            'SubstrateQty'=>$request['SubstrateQty'],
            'StatusPanen'=>0,
        ]);
        
        $Baglog = Pembibitan::where('StatusPanen', '1')->get();
        return redirect()->back()->with('message', 'Form Submitted!');
    }

    public function Monitoring()
    {
        $Mylea = Produksi::orderBy('TanggalProduksi', 'desc')->paginate(80);
        $Kontaminasi = Kontaminasi::all();
        foreach($Mylea as $data){
            $Kontaminasi = Kontaminasi::where('KPMylea', $data['KodeProduksi'])->get();
            $Panen = Panen::where('KPMylea', $data['KodeProduksi'])->get();
            $data['Konta'] = 0;
            $data['Panen'] = 0;
            foreach($Kontaminasi as $konta){
                $data['Konta'] = $data['Konta'] + $konta['Jumlah'];
            }
            foreach($Panen as $panen){
                $data['Panen'] = $data['Panen'] + $panen['Jumlah'];
            }
            $data['InStock'] = $data['Jumlah'] - $data['Konta'] - $data['Panen'];
        }
        return view('operator.Mylea.Monitoring', ['Data'=>$Mylea,]);
    }

    public function FormKontaminasi($KodeProduksi){
        $Baglog = BaglogMylea::where('KPMylea', $KodeProduksi)->get();
        return view('operator.Mylea.FormKontaminasi', [
            'KodeProduksi'=>$KodeProduksi,
            'Baglog'=>$Baglog,
        ]);
    }

    public function FormKontaminasiSubmit(Request $request)
    {
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

        
        return redirect()->back()->with('message', 'Form Submitted!');
    }

    public function DataKontaminasi($KodeProduksi){
        $Kontaminasi = Kontaminasi::where('KPMylea', $KodeProduksi)->get();
        return view('operator.Mylea.DataKontaminasi', [
            'KodeProduksi'=>$KodeProduksi,
            'Kontaminasi'=>$Kontaminasi,
        ]);
    }

    public function UpdateKontaminasi(Request $request){
        $id = $request['id'];
        Kontaminasi::find($id)->update([
            'NoBibit'=>$request['NoBibit'],
            'Jumlah'=>$request['JumlahKonta'],
            'TanggalKontaminasi'=> $request['TanggalKonta'],
            'KondisiBaglog'=>$request['KondisiBaglog'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect(url('/operator/mylea/monitoring/data-kontaminasi', ['KodeProduksi'=> $request['KPMylea'],]))->with('message', 'Data Telah Di Update!');
    }

    public function FormElus(){
        $Mylea = Produksi::orderBy('TanggalProduksi', 'desc')->paginate(80);
        $Kontaminasi = Kontaminasi::all();
        foreach($Mylea as $data){
            $Kontaminasi = Kontaminasi::where('KPMylea', $data['KodeProduksi'])->get();
            $Panen = Panen::where('KPMylea', $data['KodeProduksi'])->get();
            $data['Konta'] = 0;
            $data['Panen'] = 0;
            foreach($Kontaminasi as $konta){
                $data['Konta'] = $data['Konta'] + $konta['Jumlah'];
            }
            foreach($Panen as $panen){
                $data['Panen'] = $data['Panen'] + $panen['Jumlah'];
            }
            $data['InStock'] = $data['Jumlah'] - $data['Konta'] - $data['Panen'];
        }
        return view('operator.Mylea.FormElus', [
            'Data'=>$Mylea,
        ]);
    }

    public function FormElusSubmit(Request $request)
    {
        $request->validate([
            'TanggalElus'=> 'Required',
        ]);

        $id = Auth::user()->id;

        foreach($request->data as $key => $value){
            Elus::create([
                'user_id'=>$id,
                'TanggalElus'=>$request['TanggalElus'],
                'KPMylea'=>$value['KodeMylea'],
                'JamMulai'=>$request['JamMulai'],
                'JamSelesai'=>$request['JamSelesai'],
                'Jumlah'=>$value['Jumlah'],
            ]);
        }


        
        return redirect()->back()->with('message', 'Form Submitted!');
    }

    public function FormPanen($KodeProduksi){
        $Baglog = BaglogMylea::where('KPMylea', $KodeProduksi)->get();
        return view('operator.Mylea.FormPanen', [
            'KodeProduksi'=>$KodeProduksi,
            'Baglog'=>$Baglog,
        ]);
    }

    public function FormPanenSubmit(Request $request)
    {
        $request->validate([
            'TanggalPanen'=> 'Required',
            'JamMulai'=>'Required',
            'JamSelesai'=>'Required',
            'JumlahBaglog'=>'Required',
        ]);

        $id = Auth::user()->id;

        $PanenID = Panen::create([
            'user_id'=>$id,
            'KPMylea'=>$request['KPMylea'],
            'TanggalPanen'=>$request['TanggalPanen'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'Jumlah'=>$request['JumlahBaglog'],
            'JenisPanen'=>$request['JenisPanen'],
        ])->id;;

        foreach($request->data as $key => $value){
            PanenDetails::create([
                'user_id'=>$id,
                'PanenID'=>$PanenID,
                'KPBaglog'=>$value['KodeBaglog'],
                'Jumlah'=>$value['Jumlah'],
                'NoBibit'=>$value['NoBibit'],
                'KondisiBaglog'=>$value['KondisiBaglog'],
                'Keterangan'=>$value['Keterangan'],
            ]);
        }

        Produksi::where('KodeProduksi', $request['KPMylea'])->update([
            'StatusPanen'=> 1,
        ]);

        
        return redirect(url('/operator/mylea/monitoring'))->with('message', 'Data Panen Submitted!');
    }
}
