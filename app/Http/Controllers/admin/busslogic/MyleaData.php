<?php
namespace App\Http\Controllers\admin\busslogic;

use App\Models\Baglog\Pembibitan;
use App\Models\Mylea\Produksi;
use App\Models\Mylea\BaglogMylea;
use App\Models\Mylea\Elus;
use App\Models\Mylea\Kontaminasi;
use App\Models\Mylea\Panen;
use App\Models\Mylea\PanenDetails;
use App\Models\Baglog\BaglogRnD;

class MyleaData {
    public function all(){
        $Mylea = Produksi::sortable()->orderBy('TanggalProduksi','asc')->paginate(80);
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
            $data['JumlahPanen'] = $data['Panen']->sum('Jumlah');
            $data['InStock'] = $data['Jumlah'] - $data['Konta'] - $data['JumlahPanen'];
            $data['PersenKonta'] = $data['Konta']/$data['Jumlah']*100;
            $Baglog = BaglogMylea::where('KPMylea', $data['KodeProduksi'])
            ->select([
                'mylea_baglog.id',
                'mylea_baglog.KPBaglog',
                'mylea_baglog.JumlahBaglog',
                'mylea_baglog.KondisiBaglog',
                'baglog_pembibitan.BatchBibitTerpakai',
                'baglog_pembibitan.TanggalPengerjaan'
            ])
            ->leftjoin('baglog_pembibitan', 'baglog_pembibitan.KodeProduksi', '=', 'mylea_baglog.KPBaglog')
            ->get();
            
            $data['Baglog'] = '';
            foreach($Baglog as $baglog){
                $data['Baglog'] = $data['Baglog'].$baglog['KPBaglog'].', ';

                $startDate = new \DateTime($baglog['BatchBibitTerpakai']);
                $endDate = new \DateTime($baglog['TanggalPengerjaan']);
    
                $diff = $endDate->diff($startDate);
                $baglog['UmurBibit']= floor($diff->days / 1);

                $startDate = new \DateTime($baglog['TanggalPengerjaan']);
                $endDate = new \DateTime($data['TanggalProduksi']);
                $baglog['UmurBaglog']= floor($diff->days / 7);
    
                $diff = $endDate->diff($startDate);
            }
            $data['DataBaglog'] = $Baglog;
            $data['DataElus'] = Elus::where('KPMylea', $data['KodeProduksi'])->get();
            
            foreach($data['DataBaglog'] as $DataBaglog){
                $I3 = substr($DataBaglog['KPBaglog'], 11);
                $LastKodeProduksi = substr($data['KodeProduksi'], -1);
                $A3 = $data['TanggalProduksi'];
                if ($I3 === "MYCL2") {
                    if ((date("D", strtotime($A3)) === "Tue") || (date("D", strtotime($A3)) === "Fri")) {
                       if ($LastKodeProduksi === "D") {
                        $result = date("Y-m-d", strtotime($A3 . "+41 days"));
                       } else {
                        $result = date("Y-m-d", strtotime($A3 . "+34 days"));
                       }
                    } else {
                        if ($LastKodeProduksi === "D") {
                            $result = date("Y-m-d", strtotime($A3 . "+42 days"));
                        } else {
                            $result = date("Y-m-d", strtotime($A3 . "+35 days"));
                        }
                    } 
                } else {
                    if ((date("D", strtotime($A3)) === "Tue") || (date("D", strtotime($A3)) === "Fri")) {
                       if ($LastKodeProduksi === "D") {
                        $result = date("Y-m-d", strtotime($A3 . "+41 days"));
                       } else {
                        $result = date("Y-m-d", strtotime($A3 . "+34 days"));
                       }
                    } else {
                        if ($LastKodeProduksi === "D") {
                            $result = date("Y-m-d", strtotime($A3 . "+42 days"));
                        } else {
                            $result = date("Y-m-d", strtotime($A3 . "+35 days"));
                        }
                    } 
                }
                $data['JadwalPanen'] = $result;
            }

        }
        $Baglog = Pembibitan::where('StatusArchive', NULL)->where('StatusPanen', '1')->get();
        $BaglogRnD = BaglogRnD::where('StatusArchive', NULL)->orWhere('StatusArchive', '0')->get();
        return $Mylea;
    }

    public function GetTanggalPanen($data){
        $Baglog = BaglogMylea::where('KPMylea', $data['KodeProduksi'])
        ->select([
            'mylea_baglog.id',
            'mylea_baglog.KPBaglog',
            'mylea_baglog.JumlahBaglog',
            'mylea_baglog.KondisiBaglog',
            'baglog_pembibitan.BatchBibitTerpakai',
            'baglog_pembibitan.TanggalPengerjaan'
        ])
        ->leftjoin('baglog_pembibitan', 'baglog_pembibitan.KodeProduksi', '=', 'mylea_baglog.KPBaglog')
        ->get();
        $data['DataBaglog'] = $Baglog;

        foreach($data['DataBaglog'] as $DataBaglog){
            $I3 = substr($DataBaglog['KPBaglog'], 11);
            $LastKodeProduksi = substr($data['KodeProduksi'], -1);
            $A3 = $data['TanggalProduksi'];
            if ($I3 === "MYCL2") {
                if ((date("D", strtotime($A3)) === "Tue") || (date("D", strtotime($A3)) === "Fri")) {
                   if ($LastKodeProduksi === "D") {
                    $result = date("Y-m-d", strtotime($A3 . "+41 days"));
                   } else {
                    $result = date("Y-m-d", strtotime($A3 . "+34 days"));
                   }
                } else {
                    if ($LastKodeProduksi === "D") {
                        $result = date("Y-m-d", strtotime($A3 . "+42 days"));
                    } else {
                        $result = date("Y-m-d", strtotime($A3 . "+35 days"));
                    }
                } 
            } else {
                if ((date("D", strtotime($A3)) === "Tue") || (date("D", strtotime($A3)) === "Fri")) {
                   if ($LastKodeProduksi === "D") {
                    $result = date("Y-m-d", strtotime($A3 . "+41 days"));
                   } else {
                    $result = date("Y-m-d", strtotime($A3 . "+34 days"));
                   }
                } else {
                    if ($LastKodeProduksi === "D") {
                        $result = date("Y-m-d", strtotime($A3 . "+42 days"));
                    } else {
                        $result = date("Y-m-d", strtotime($A3 . "+35 days"));
                    }
                } 
            }
            $data['JadwalPanen'] = $result;
        }
        return $data['JadwalPanen'];
    }

}

?>