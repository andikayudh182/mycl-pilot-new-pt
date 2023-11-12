<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Pengayakan;
use App\Models\Baglog\Resep;
use App\Models\Baglog\Mixing;
use App\Models\Baglog\Pembibitan;
use App\Models\Baglog\PemakaianSterilisasi;
use App\Models\Baglog\Sterilisasi;
use App\Models\Baglog\Kontaminasi;
use App\Models\Baglog\Crushing;
use App\Models\Baglog\BaglogRnD;
use App\Models\Mylea\BaglogMylea;
use CreateBaglogPemakaianSterilisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaglogController extends Controller
{
    public function Pengayakan(){
        $id = Auth::user()->id;
        return view ('operator.Baglog.Pengayakan', ['id'=>$id,]);
    }
    
    public function PengayakanSubmit(Request $request, $id){
        $Pengayakan = $request->validate([
            'TanggalPengerjaan' => 'Required',
            'NoKarung' => 'Required',
            'BeratAwal' => 'Required',
            'BeratAkhir' => 'Required',
            'NoKontainer',
        ]);

        Pengayakan::create([
            'TanggalPengerjaan' => $Pengayakan['TanggalPengerjaan'],
            'NoKarung' => $Pengayakan['NoKarung'],
            'BeratAwal' => $Pengayakan['BeratAwal'],
            'BeratAkhir' => $Pengayakan['BeratAkhir'],
            'NoKontainer' => $request['NoKontainer'],
            'user_id' => $id,
        ]);
        return redirect(url('/operator/baglog/pengayakan'))->with('message', 'Data Telah Ditambahkan');
    }

    public function CalcRecipe(){
        $id = Auth::user()->id;
        return view ('operator.Baglog.CalcResep', ['id'=>$id,]);
    }

    public function CalcRecipeSubmit(Request $request, $id){
        $Resep = $request->validate([
            'TotalBags'=>'Required',
            'WeightperBag'=>'Required',
            'MCSKayu'=>'Required',
            'NoKarungSKayu'=>'Required',
            'MCPollard'=>'Required',
            'MCCaCO3'=>'Required',
        ]);

        $W = $request->input('WeightperBag');
        $T = $request->input('TotalBags');
        $x = 0.35 * $W;
        $MCSKayu = $request->input('MCSKayu');
        $MCCaCO3 = $request->input('MCCaCO3');
        $MCPollard = $request->input('MCPollard');
        $MCTapioka = $request->input('MCTapioka');
        $SKayu = $x * 0.67 * 0.1 / (100 - $MCSKayu);
        $CaCO3 = $x * 0.03 * 0.1 / (100 - $MCCaCO3);
        $Pollard = $x * 0.20 * 0.1 / (100 - $MCPollard);
        $Tapioka = $x * 0.10 * 0.1 / (100 - $MCTapioka);
        $TotalW = $CaCO3 + $SKayu + $Pollard + $Tapioka;
        $Air = ((0.65 * $W)/1000) - ($TotalW - ($x/1000)) ;

        Resep::create([
            'user_id'=>$id,
            'BeratBaglog'=>$request['WeightperBag'],
            'TotalBags'=>$request['TotalBags'],
            'SKayu'=>$SKayu*$T,
            'MCSKayu'=>$MCSKayu,
            'NoKarungSKayu'=>$request['NoKarungSKayu'],
            'Pollard'=>$Pollard*$T,
            'MCPollard'=>$MCPollard,
            'Tapioka'=>$Tapioka*$T,
            'MCTapioka'=>$MCTapioka,
            'Kapur'=>$CaCO3*$T,
            'MCKapur'=>$MCCaCO3,
            'Air'=>$Air*$T,
            'Hickory'=>'0',
            'MCHickory'=>'0',
            'Status'=>'0',
            'Approval'=>'0',
        ]);
        return redirect(url('/operator/baglog/calcrecipe'))->with('message', 'Data Telah Ditambahkan');
    }

    public function Mixing(){
        $resep = Resep::all()->where('Status', '=', '0');

        return view ('operator.Baglog.Mixing', ['resep'=>$resep,]);
    }

    public function EditResep(Request $request){
        $id = $request['id'];
        Resep::find($id)->update([
            'BeratBaglog'=>$request['WeightperBag'],
            'TotalBags'=>$request['TotalBags'],
            'SKayu'=>$request['SKayu'],
            'MCSKayu'=>$request['MCSKayu'],
            'NoKarungSKayu'=>$request['NoKarungSKayu'],
            'Pollard'=>$request['Pollard'],
            'MCPollard'=>$request['MCPollard'],
            'Tapioka'=>$request['Tapioka'],
            'MCTapioka'=>$request['MCTapioka'],
            'Kapur'=>$request['CaCO3'],
            'MCKapur'=>$request['MCCaCO3'],
            'Air'=>$request['Air'],
        ]);

        return redirect(url('/operator/baglog/mixing'))->with('message', 'Data Telah Di-Update!');
    }

        public function DeleteResep($id){
        Resep::find($id)->update([
            'DeleteStatus'=> 1,
        ]);

        return redirect(url('/operator/baglog/mixing'))->with('message2', 'Data Telah Dihapus');
    }

    public function MixingForm($resep_id){
        return view ('operator.Baglog.FormMixing', ['resep_id'=>$resep_id]);
    }

    public function MixingFormSubmit(Request $request, $resep_id){
        $user_id = Auth::user()->id;
        $Mixing = $request->validate([
            'TanggalPengerjaan'=>'Required',
            'Batch'=>'Required',
            'JamMulai'=>'Required',
            'JamSelesai'=>'Required',
            'JumlahBaglog'=>'Required',
            'MCBaglog'=>'Required',
        ]);

        Mixing::create([
            'TanggalPengerjaan'=>$request['TanggalPengerjaan'],
            'Batch'=>$request['Batch'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'MCBaglog'=>$request['MCBaglog'],
            'MCBaglogAkhir'=>$request['MCBaglogAkhir'],
            'BeratAktual'=>$request['BeratAktual'],
            'user_id'=>$user_id,
            'resep_id'=>$resep_id,
        ]);
        $update = Resep::find($resep_id);

        if($update){
            $update->Status = '1';
            $update->save();
        }
        $resep = Resep::all()->where('Status', '=', '0');

        return redirect(url('/operator/baglog/mixing'))->with('message', 'Data Mixing Telah Di-Submit');
    }

    public function SterilisasiOption(){
        $mixing = Mixing::all();
        $data = [];
        foreach($mixing as $MD){
            $Sterilisasi = Sterilisasi::where('mixing_id', $MD['id'])->get();
            if(isset($Sterilisasi)){
                $JumlahTerpakai = 0;
                foreach($Sterilisasi as $SD){
                    $JumlahTerpakai = $JumlahTerpakai + $SD['JumlahBaglog'];
                }
                    $MD['InStock'] = $MD['JumlahBaglog'] - $JumlahTerpakai;
                    if($MD['InStock'] <= 0){
                        
                    } else{
                        $data[] = $MD;
                    }

            } else {
                $data[] = $MD;
            }
        }
        return view ('operator.Baglog.SterilisasiOption',[
            'data'=>$data,
        ]);
    }

    public function Sterilisasi($data){
        return view ('operator.Baglog.Sterilisasi', [
            'data'=>$data,
        ]);
    }

    public function SterilisasiSubmit(Request $request){
        $user_id = Auth::user()->id;
        $Sterilisasi = $request->validate([
            'TanggalPengerjaan'=>'Required',
            'NoAutoclave'=>'Required',
            'JamMulai'=>'Required',
            'JamSelesai'=>'Required',
            'JumlahBaglog'=>'Required',
        ]);

        Sterilisasi::create([
            'TanggalPengerjaan'=>$request['TanggalPengerjaan'],
            'Batch'=>$request['Batch'],
            'NoAutoclave'=>$request['NoAutoclave'],
            'JamMulai'=>$request['JamMulai'],
            'JamSelesai'=>$request['JamSelesai'],
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'Kondisi'=>$request['Kondisi'],
            'JumlahBaglogBerlubang'=>$request['JumlahBaglogBerlubang'],
            'JumlahTapeTidakHitam'=>$request['JumlahTapeTidakHitam'],
            'mixing_id'=>$request['mixing_id'],
            'user_id'=>$user_id,
        ]);


        return redirect(url('/operator/baglog/sterilisasi-option'))->with('message', 'Data Sterilisasi Telah Ditambahkan');
    }

    public function Pembibitan(){
        $Sterilisasi = Sterilisasi::where('pembibitan_kp', null)->get();
        
        foreach($Sterilisasi as $Data){
            $Data['Terpakai'] = 0;
            $Pemakaian = PemakaianSterilisasi::where('SterilisasiID', $Data['id'])->get();
            if(isset($Pemakaian)){
                $Data['Terpakai'] = $Data['Terpakai'] + $Pemakaian->sum('Jumlah');
            }
            $Data['InStock'] = $Data['JumlahBaglog'] - $Data['Terpakai'];
        }
        return view ('operator.Baglog.Pembibitan', [
            'DataSterilisasi'=>$Sterilisasi,
        ]);
    }

    public function PembibitanSubmit(Request $request){
        $pembibitan = $request->validate([
            'TanggalPengerjaan'=>'Required',
            'Batch'=> 'Required',
            'JumlahBaglog'=>'Required',
            'Kondisi'=>'Required',
            'BibitTerpakai'=>'Required',
            'BatchBibitTerpakai'=>'Required',
            'BibitReject'=>'Required',
        ]);

        $TanggalCrushing = date('Y-m-d', strtotime($request['TanggalPengerjaan']. ' + 7 days'));
        $TanggalHarvest = date('Y-m-d', strtotime($request['TanggalPengerjaan']. ' + 14 days'));
        $TB = $newDate = date("y-m-d", strtotime($request['TanggalPengerjaan']));
        $KodeProduksi =  "BL".$request['Batch'].$TB.$request['KodeBibit'];
        $user_id = Auth::user()->id;
        $TanggalSterilisasi = "";
        $IDSterilisasi = "";

        foreach($request->data as $key => $value){
            $Tanggal= Sterilisasi::where('id', $value['sterilisasi_id'])->get();
            $TanggalSterilisasi = $TanggalSterilisasi.$Tanggal[0]['TanggalPengerjaan'].",";
            $IDSterilisasi = $IDSterilisasi.$value['sterilisasi_id'].",";
        }

        $PembibitanID = Pembibitan::create([
            'TanggalPengerjaan'=>$pembibitan['TanggalPengerjaan'],
            'Batch'=> $pembibitan['Batch'],
            'TanggalSterilisasi'=>$TanggalSterilisasi,
            'sterilisasi_id'=>$IDSterilisasi,
            'JumlahBaglog'=>$pembibitan['JumlahBaglog'],
            'Kondisi'=>$pembibitan['Kondisi'],
            'BibitTerpakai'=>$pembibitan['BibitTerpakai'],
            'BatchBibitTerpakai'=>$pembibitan['BatchBibitTerpakai'],
            'BibitReject'=>$pembibitan['BibitReject'],
            'BatchBibitDibuang'=>$request['BatchBibitDibuang'],
            'KodeProduksi'=>$KodeProduksi,
            'TanggalCrushing'=>$TanggalCrushing,
            'TanggalPanen'=>$TanggalHarvest,
            'StatusCrushing'=>'0',
            'StatusPanen'=>'0',
            'user_id'=>$user_id,
        ])->id;

        foreach($request->data as $key => $value){
            PemakaianSterilisasi::create([
                'SterilisasiID'=>$value['sterilisasi_id'],
                'PembibitanID'=>$PembibitanID,
                'Jumlah'=>$value['Jumlah'],
            ]);
        }

        return redirect(url('/operator/baglog/pembibitan'))->with('message', 'Data Telah Ditambahkan');
    }

    public function InkubasiBaglog(){
        $pembibitan = Pembibitan::where('StatusArchive', '=', NULL)->orderBy('TanggalPengerjaan', 'desc')->paginate(80);

        return view ('operator.Baglog.InkubasiBaglog', ['Pembibitan'=>$pembibitan]);
    }

    public function DeleteBaglog($id){
        Pembibitan::where('id', $id)->delete();
        PemakaianSterilisasi::where('PembibitanID', $id)->delete();

        return redirect()->back()->with('message', 'Data Telah Dihapus');
    }

    public function InkubasiBaglogEditForm($id){
        $data = Pembibitan::where('id', $id)->get()->first();
        $dataSterilisasi= PemakaianSterilisasi::where('PembibitanID', $id)
        ->join('baglog_sterilisasi', 'baglog_pemakaian_sterilisasi.SterilisasiID', 'baglog_sterilisasi.id')
        ->select('baglog_sterilisasi.*')->get();
        $data['KodeBibit'] = substr($data['KodeProduksi'], 11);

        $Sterilisasi = Sterilisasi::where('pembibitan_kp', null)->get();
        
        foreach($Sterilisasi as $item){
            $item['Terpakai'] = 0;
            $Pemakaian = PemakaianSterilisasi::where('SterilisasiID', $item['id'])->get();
            if(isset($Pemakaian)){
                $item['Terpakai'] = $item['Terpakai'] + $Pemakaian->sum('Jumlah');
            }
            $item['InStock'] = $item['JumlahBaglog'] - $item['Terpakai'];
        }

        return view('operator.Baglog.EditInkubasiBaglog', [
            'data' => $data,
            'DataSterilisasi' => $Sterilisasi,
            'DataPemakaianSterilisasi' => $dataSterilisasi
        ]);
    }

    public function InkubasiBaglogEdit($id, Request $request){
        $TanggalCrushing = date('Y-m-d', strtotime($request['TanggalPengerjaan']. ' + 7 days'));
        $TanggalHarvest = date('Y-m-d', strtotime($request['TanggalPengerjaan']. ' + 14 days'));
        $TB = $newDate = date("y-m-d", strtotime($request['TanggalPengerjaan']));
        $KodeProduksi =  "BL".$request['Batch'].$TB.$request['KodeBibit'];
        $user_id = Auth::user()->id;
        $TanggalSterilisasi = "";
        $IDSterilisasi = "";

        $cm = array_column($request['data'], 'sterilisasi_id');
        if($cm != array_unique($cm)){
            return redirect()->back()->with('Error', 'Message : ' . "Terdapat duplikat untuk data inkubasi");
        }


        foreach($request->data as $key => $value){
            $Tanggal= Sterilisasi::where('id', $value['sterilisasi_id'])->get();
            $TanggalSterilisasi = $TanggalSterilisasi.$Tanggal[0]['TanggalPengerjaan'].",";
            $IDSterilisasi = $IDSterilisasi.$value['sterilisasi_id'].",";
        }
        Pembibitan::find($id)->update([
            'TanggalPengerjaan'=>$request['TanggalPengerjaan'],
            'Batch'=> $request['Batch'],
            'TanggalSterilisasi'=>$TanggalSterilisasi,
            'sterilisasi_id'=>$IDSterilisasi,
            'JumlahBaglog'=>$request['JumlahBaglog'],
            'Kondisi'=>$request['Kondisi'],
            'BibitTerpakai'=>$request['BibitTerpakai'],
            'BatchBibitTerpakai'=>$request['BatchBibitTerpakai'],
            'BibitReject'=>$request['BibitReject'],
            'BatchBibitDibuang'=>$request['BatchBibitDibuang'],
            'KodeProduksi'=>$KodeProduksi,
            'TanggalCrushing'=>$TanggalCrushing,
            'TanggalPanen'=>$TanggalHarvest,
            'StatusCrushing'=>'0',
            'StatusPanen'=>'0',
            'user_id'=>$user_id,
        ]);

        PemakaianSterilisasi::where('PembibitanID', $id)->delete();

        foreach($request->data as $key => $value){
            PemakaianSterilisasi::create([
                'SterilisasiID'=>$value['sterilisasi_id'],
                'PembibitanID'=>$id,
                'Jumlah'=>$value['Jumlah'],
            ]);
        }
        return redirect()->back()->with('message', 'Data telah di update');
    }

    public function InkubasiBaglogKonta($id){
        $konta = Pembibitan::find($id);
        return view ('operator.Baglog.Konta', ['Konta'=>$konta,]);
    }

    public function InkubasiKontaData($KodeProduksi){
        $konta = Kontaminasi::where('KodeProduksi', $KodeProduksi)->get();
        return view ('operator.Baglog.DataKontaminasi', ['Konta'=>$konta,]);
    }

    public function InkubasiKontaDataUpdate(Request $request){
        $id = $request['id'];
        Kontaminasi::find($id)->update([
            'KodeProduksi'=>$request['KodeProduksi'],
            'NoBibit'=>$request['NoBibit'],
            'JumlahKonta'=>$request['JumlahKonta'],
            'TanggalKonta'=> $request['TanggalKonta'],
            'Keterangan'=>$request['Keterangan'],
        ]);
        return redirect(url('/operator/baglog/inkubasi-baglog/konta-data', ['KodeProduksi'=> $request['KodeProduksi'],]))->with('message', 'Data Telah Di Update!');
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
        return redirect(url('/operator/baglog/inkubasi-baglog'))->with('message', 'Data Kontaminasi Telah Ditambahkan');
    }

    public function InkubasiBaglogCrushing($id){
        $update = Pembibitan::find($id);

        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return view('operator.Baglog.Crushing', ['id' => $id, 'KodeProduksi' => $update['KodeProduksi'],]);
    }

    public function BaglogCrushingSubmit(Request $request){
        $update = Pembibitan::find($request['pembibitan_id']);
        $user_id = Auth::user()->id;

        if($update){
            $update->StatusCrushing = '1';
            $update->save();
        }
        $request->validate([
            'TanggalCrushing'=>'required',
            'JamMulai'=>'required',
            'JamSelesai'=>'required',
            'KondisiBaglog'=>'required',
            'JumlahBaglogPutih'=>'required',
            'JumlahBaglogTidakTumbuh'=>'required',
            'JumlahBaglogTidakMerata'=>'required',
            'TotalBaglog'=>'required',
        ]);
        $request['user_id'] = $user_id;
        Crushing::create([
            'user_id'=>$user_id,
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

        return redirect(url('/operator/baglog/inkubasi-baglog'))->with('message', 'Data Crushing Telah Ditambahkan');
    }

    public function InkubasiBaglogCrushingUndo($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusCrushing = '0';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return redirect(url('/operator/baglog/inkubasi-baglog'));
    }

    public function InkubasiBaglogPanen($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusPanen = '1';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusPanen', '=', '0');
        return redirect(url('/operator/baglog/inkubasi-baglog'))->with('message', 'Data Status Panen Telah Di-Update');
    }

    public function InkubasiBaglogArchive($id){
        $update = Pembibitan::find($id);

        if($update){
            $update->StatusArchive = '1';
            $update->save();
        }
        $pembibitan = Pembibitan::all()->where('StatusArchive', '=', NULL);
        return redirect(url('/operator/baglog/inkubasi-baglog'))->with('message', 'Data Status Archive Telah Di-Update');
    }

    public function BaglogRnD(){
        $Baglog = BaglogRnD::orderBy('StatusArchive', 'asc')
        ->orderBy('TanggalBaglog', 'asc')->get();
        foreach($Baglog as $Data){
            $Pemakaian = BaglogMylea::where('KPBaglog', $Data['KodeProduksi'])->get();
            $Data['Pemakaian'] = $Pemakaian;
            $Data['InStock'] = $Data['Jumlah'] - $Pemakaian->sum('JumlahBaglog');
            if($Data['Departemen']== Null){
                $Data['KodeProduksi'] = $Data['JenisResep'].$Data['TanggalBaglog'];
            }
        }
        return view('operator.Baglog.BaglogRnD', [
            'Baglog'=>$Baglog,
        ]);
    }

    public function BaglogRnDSubmit(Request $request){
        $BaglogRnD = $request->validate([
            'TanggalBaglog'=>'Required',
            'Departemen'=>'Required',
            'JenisResep'=> 'Required',
            'JumlahBaglog'=>'Required',
        ]);

        $KodeProduksi = $BaglogRnD['JenisResep'].$BaglogRnD['TanggalBaglog'];
        $id = Auth::user()->id;

        BaglogRnD::create([
            'user_id'=>$id,
            'KodeProduksi'=>$KodeProduksi,
            'Departemen'=>$BaglogRnD['Departemen'],
            'JenisResep'=>$BaglogRnD['JenisResep'],
            'TanggalBaglog'=>$BaglogRnD['TanggalBaglog'],
            'Jumlah'=>$BaglogRnD['JumlahBaglog'],
            'Keterangan'=>$request['Keterangan'],
        ]);

        return redirect(url('/operator/baglog/baglog-rnd'))->with('message', 'Data Telah Ditambahkan');
    }

    public function BaglogRnDUpdate(Request $request){
        BaglogRnD::find($request['id'])->update([
            'JenisResep'=>$request['JenisResep'],
            'TanggalBaglog'=>$request['TanggalBaglog'],
            'Jumlah'=>$request['JumlahBaglog'],
            'Keterangan'=>$request['Keterangan'],
            'StatusArchive'=>$request['StatusArchive'],
        ]);

        return redirect(url('/operator/baglog/baglog-rnd'))->with('message', 'Data Telah Di-Update!');
    }
    
    public function BaglogRnDDelete($id){
        BaglogRnD::find($id)->delete();

        return redirect(url('/operator/baglog/baglog-rnd'))->with('message', 'Data Telah Dihapus!');
    }
}
