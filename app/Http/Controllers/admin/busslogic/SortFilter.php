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

class SortFilter {
    public function FilterByTanggalProduksi($Date1, $Date2){
        $Collection = Produksi::sortable()
        ->whereBetween('TanggalProduksi', [$Date1, $Date2])
        ->orderBy('TanggalProduksi','desc')
        ->paginate(80);
        return $Collection;
    }

    public function SortKonta($Mylea, $request){
        if(isset($request)){
            if($request == 'ASC'){
                $Mylea = $Mylea->sortBy('Konta');
            } else {
                $Mylea = $Mylea->sortByDesc('Konta');
            }
        }
        return $Mylea;
    }

    public function SortPanen($Mylea, $request){
        if(isset($request)){
            if($request == 'ASC'){
                $Mylea = $Mylea->sortBy('JumlahPanen');
            } else {
                $Mylea = $Mylea->sortByDesc('JumlahPanen');
            }
        }
        return $Mylea;
    }

    public function SortPersenKonta($Mylea, $request){
        if(isset($request)){
            if($request == 'ASC'){
                $Mylea = $Mylea->sortBy('PersenKonta');
            } else {
                $Mylea = $Mylea->sortByDesc('PersenKonta');
            }
        }
        return $Mylea;
    }

    public function SortInStock($Mylea, $request){
        if(isset($request)){
            if($request == 'ASC'){
                $Mylea = $Mylea->sortBy('InStock');
            } else {
                $Mylea = $Mylea->sortByDesc('InStock');
            }
        }
        return $Mylea;
    }

    public function Filter($Mylea, $request){
        if($request['JumlahTrayNumber'] != ''){
            $Mylea = $Mylea->where('Jumlah', $request['JumlahTrayOperator'], $request['JumlahTrayNumber']);
        }
        if($request['KontaminasiNumber'] != ''){
            $Mylea = $Mylea->where('Konta', $request['KontaminasiOperator'], $request['KontaminasiNumber']);
        }
        if($request['PersenKontaNumber'] != ''){
            $Mylea = $Mylea->where('PersenKonta', $request['PersenKontaOperator'], $request['PersenKontaNumber']);
        }
        if($request['PanenNumber'] != ''){
            $Mylea = $Mylea->where('JumlahPanen', $request['PanenOperator'], $request['PanenNumber']);
        }
        if($request['InStockNumber'] != ''){
            $Mylea = $Mylea->where('InStock', $request['InStockOperator'], $request['InStockNumber']);
        }
        return $Mylea;
    }
}

?>