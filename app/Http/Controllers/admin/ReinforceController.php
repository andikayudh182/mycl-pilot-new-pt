<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTreatment\Curing;
use App\Models\PostTreatment\Reinforce;

class ReinforceController extends Controller
{
    public function ReinforceIndex() {
        $Data = Curing::join('post_treatment', 'curing.PT_ID', '=', 'post_treatment.id')
                ->select('curing.id', 'curing.PT_ID', 'curing.Warna', 'curing.SizeSatu', 'curing.SizeDua', 'curing.SizeTiga', 'post_treatment.Batch')
                ->get();


        $transformedData = [];
        
        foreach ($Data as $item) {
            
            $usedSizeSatu = Curing::join('reinforce', 'curing.id', '=', 'reinforce.CuringID')
                            ->where('reinforce.CuringID', $item['id'])
                            ->where('reinforce.Size', '15 x 15')
                            ->sum('reinforce.Jumlah');
            $usedSizeDua = Curing::join('reinforce', 'curing.id', '=', 'reinforce.CuringID')
                            ->where('reinforce.CuringID', $item['id'])
                            ->where('reinforce.Size', '25 x 30')
                            ->sum('reinforce.Jumlah');
            $usedSizeTiga = Curing::join('reinforce', 'curing.id', '=', 'reinforce.CuringID')
                            ->where('reinforce.CuringID', $item['id'])
                            ->where('reinforce.Size', '>30 x 30')
                            ->sum('reinforce.Jumlah');
        
            $transformedData[] = [
                'id' => $item->id,
                'PT_ID' => $item->PT_ID,
                'Warna' => $item->Warna,
                'Batch' => $item->Batch,
                'Size' => '15 x 15',
                'Jumlah' => $item->SizeSatu - $usedSizeSatu,
            ];
            $transformedData[] = [
                'id' => $item->id,
                'PT_ID' => $item->PT_ID,
                'Warna' => $item->Warna,
                'Batch' => $item->Batch,
                'Size' => '25 x 30',
                'Jumlah' => $item->SizeDua - $usedSizeDua,
            ];
            $transformedData[] = [
                'id' => $item->id,
                'PT_ID' => $item->PT_ID,
                'Warna' => $item->Warna,
                'Batch' => $item->Batch,
                'Size' => '>30 x 30',
                'Jumlah' => $item->SizeTiga - $usedSizeTiga,
            ];
        }
        
        return view('admin.Reinforce.Index', [
            'FormData' => $transformedData
        ]);

        
        
    }

    public function ReinforceSubmit (Request $request){

        try {
            $tanggalPengerjaan = $request['TanggalPengerjaan'];

            if (isset($request['data'])) {
                foreach($request->data as $key=> $value){
                    $selectedOption = $value['CuringID'];
                    
                    if ($selectedOption) {
                        $valuesExplode = explode(",", $selectedOption);
                
                        if (count($valuesExplode) === 2) {
                            Reinforce::create([
                                'CuringID' => $valuesExplode[0],
                                'Size' => $valuesExplode[1],
                                'TanggalPengerjaan' => $tanggalPengerjaan,
                                'Jumlah' => $value['Jumlah'],
                            ]);
                        }
                    }
                }
            }

            return redirect(route('ReinforceIndex'))->with('Success', 'Input Reinforce Data Success!');
        } catch (\Exception $e) {
            return redirect(route('ReinforceIndex'))->with('Error', ' Message : '. $e->getMessage());
        }
        
    }

    // public function FormPostTreatmentSubmit(Request $request)
    // {
    //     if(isset($request['id']) && $request['id'] != null){
    //         PostTreatment::where('id', $request['id'])->update([
    //             'Tanggal'=>$request['Tanggal'],
    //             'Batch'=>$request['Batch'],
    //         ]);
    //         echo $request['id'];
    //         if(isset($request['data'])){
    //             foreach($request->data as $key => $value){
    //                 PostTreatmentDetails::create([
    //                     'PT_ID'=> $request['id'],
    //                     'Panen_ID'=> $value['KodeMylea'],
    //                     'Jumlah'=> $value['Jumlah'],
    //                 ]);
    //             }
    //             $PostTreatmentDetails = PostTreatmentDetails::where('PT_ID', $request['id'])->get();
    //             PostTreatment::where('id', $request['id'])->update([
    //                 'Jumlah'=>$PostTreatmentDetails->sum('Jumlah'),
    //             ]);
    //         }
    //         return redirect()->back()->with('message', 'Data Updated');
    //     }
    //     $request->validate([
    //         'Tanggal'=> 'Required',
    //     ]);

    //     $id = Auth::user()->id;
    //     $Total = 0;
    //     $PT_ID = PostTreatment::create([
    //         'user_id'=>$id,
    //         'Tanggal'=>$request['Tanggal'],
    //         'Batch'=>$request['Batch'],
    //         'Jumlah'=>$Total,
    //     ])->id;

    //     foreach($request->data as $key => $value){
    //         PostTreatmentDetails::create([
    //             'PT_ID'=> $PT_ID,
    //             'Panen_ID'=> $value['KodeMylea'],
    //             'Jumlah'=> $value['Jumlah'],
    //         ]);

    //         $Total = $Total + $value['Jumlah'];
    //     }
    //     PostTreatment::where('id', $PT_ID)->update([
    //         'Jumlah'=>$Total,
    //     ]);
    //     return redirect()->back()->with('message', 'Form Submitted!');
    // }
}
