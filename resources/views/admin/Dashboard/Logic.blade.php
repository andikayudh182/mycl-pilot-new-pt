<?php
    function MyleaSuccessRate($Mylea, $Month, $TodayDate){
        $Mylea = $Mylea->where('TanggalProduksi', $Month)->sortByDesc('TanggalPanen', SORT_NATURAL);
        $HarvestDone = $Mylea->first();

        $SuccessRate = 0;

        if($Mylea->sum('Jumlah') !== 0){
            // if($HarvestDone['TanggalPanen'] < $TodayDate){
                $SuccessRate = round(($Mylea->sum('JumlahPanen')/$Mylea->sum('Jumlah') * 100), 2);
            // } else {
                // $SuccessRate = round((($Mylea->sum('Jumlah') - $Mylea->sum('JumlahKonta'))/$Mylea->sum('Jumlah') * 100), 2);
            // }
            
        } else {
            $SuccessRate = 0;
        }
        return $SuccessRate;
    }

    function BaglogContamination($Baglog, $Month){
        if($Baglog->where('TanggalPengerjaan', $Month)->sum('JumlahBaglog') != 0){
            $Contamination = round(100 - ($Baglog->where('TanggalPengerjaan', $Month)->sum('JumlahKonta')/$Baglog->where('TanggalPengerjaan', $Month)->sum('JumlahBaglog') * 100), 2);
        } else {
            $Contamination = 0;
        }
        return $Contamination;
    }
    function QuarterBaglog($Baglog, $Quartal, $MaxCapacity){
        if($Quartal == 1){
            $Data['TotalProduction'] = $Baglog->where('TanggalPengerjaan', '01')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '02')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '03')->sum('JumlahBaglog');
            $Data['TotalContamination'] = $Baglog->where('TanggalPengerjaan', '01')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '02')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '03')->sum('JumlahKonta');
        }
        else if ($Quartal == 2){
            $Data['TotalProduction'] = $Baglog->where('TanggalPengerjaan', '04')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '05')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '06')->sum('JumlahBaglog');
            $Data['TotalContamination'] = $Baglog->where('TanggalPengerjaan', '04')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '05')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '06')->sum('JumlahKonta');
        }
        else if ($Quartal == 3){
            $Data['TotalProduction'] = $Baglog->where('TanggalPengerjaan', '07')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '08')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '09')->sum('JumlahBaglog');
            $Data['TotalContamination'] = $Baglog->where('TanggalPengerjaan', '07')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '08')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '09')->sum('JumlahKonta');
        }
        else if ($Quartal == 4){
            $Data['TotalProduction'] = $Baglog->where('TanggalPengerjaan', '10')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '11')->sum('JumlahBaglog') + $Baglog->where('TanggalPengerjaan', '12')->sum('JumlahBaglog');
            $Data['TotalContamination'] = $Baglog->where('TanggalPengerjaan', '10')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '11')->sum('JumlahKonta') + $Baglog->where('TanggalPengerjaan', '12')->sum('JumlahKonta');
        }
        $Data['Capacity'] = round($Data['TotalProduction'] / ($MaxCapacity * 16 * 3) * 100, 2);
        if($Data['TotalProduction'] != 0){
            $Data['SuccessRate'] = round(($Data['TotalProduction']-$Data['TotalContamination'])/$Data['TotalProduction']*100, 2);
        } else {
            $Data['SuccessRate'] = 0;
        }
        

        return $Data;
    }
    function QuarterMylea($Mylea, $Quartal, $MaxCapacity){
        if($Quartal == 1){
            $Data['TotalProduction'] = $Mylea->where('TanggalProduksi', '01')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '02')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '03')->sum('Jumlah');
            $Data['TotalPanen'] = $Mylea->where('TanggalProduksi', '01')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '02')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '03')->sum('JumlahPanen');
        }
        else if ($Quartal == 2){
            $Data['TotalProduction'] = $Mylea->where('TanggalProduksi', '04')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '05')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '06')->sum('Jumlah');
            $Data['TotalPanen'] = $Mylea->where('TanggalProduksi', '04')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '05')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '06')->sum('JumlahPanen');
        }
        else if ($Quartal == 3){
            $Data['TotalProduction'] = $Mylea->where('TanggalProduksi', '07')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '08')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '09')->sum('Jumlah');
            $Data['TotalPanen'] = $Mylea->where('TanggalProduksi', '07')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '08')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '09')->sum('JumlahPanen');
        }
        else if ($Quartal == 4){
            $Data['TotalProduction'] = $Mylea->where('TanggalProduksi', '10')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '11')->sum('Jumlah') + $Mylea->where('TanggalProduksi', '12')->sum('Jumlah');
            $Data['TotalPanen'] = $Mylea->where('TanggalProduksi', '10')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '11')->sum('JumlahPanen') + $Mylea->where('TanggalProduksi', '12')->sum('JumlahPanen');
        }
        $Data['Capacity'] = round($Data['TotalProduction'] / ($MaxCapacity * 3) * 100, 2);
        if($Data['TotalProduction'] != 0){
            $Data['SuccessRate'] = round(($Data['TotalPanen'])/$Data['TotalProduction']*100, 2);
            // $Data['SuccessRate'] = $Data['TotalPanen'];
        } else {
            $Data['SuccessRate'] = 0;
        }

        return $Data;
    }
    function SuccessRate($Quarter, $Target){
        if($Target > $Quarter['SuccessRate']){
            $Result['Text'] = 'Not Achieved'.' / '.$Quarter['SuccessRate'].'%';
            $Result['Style'] = 'table-danger';     
        } else {
            $Result['Text'] = 'Achieved'.' / '.$Quarter['SuccessRate'].'%';
            $Result['Style'] = 'table-success';
        }
        return $Result;
    }
?>