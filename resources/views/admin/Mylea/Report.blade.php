@extends('layouts.admin')

@section('content')


<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
    </nav>
</div>

<div class="m-5">
    <h2><b>Mylea Production Report</b></h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Summary</div>
                <div class="card-body">
                    <table width="100%"  style="font-size: 0.9rem;">
                        <tr>
                            <td>Total Production</td>
                            <td>:</td>
                            <td>{{$DataAll->sum('Jumlah')}}</td>
                            <td>pcs</td>
                        </tr>
                        <tr>
                            <td width="50%">Total Under Incubation</td>
                            <td width="5%">:</td>
                            <td width="17%">{{$DataAll->sum('InStock')}}</td>
                            <td>pcs</td>
                        </tr>
                        <tr>
                            <td>Total Contamination</td>
                            <td>:</td>
                            <td>{{$DataAll->sum('Konta')}}</td>
                            <td>pcs</td>
                        </tr>
                        <tr>
                            <td>Total Contamination Rate</td>
                            <td>:</td>
                            <td>@if($DataAll->sum('Jumlah')){{round($DataAll->sum('Konta')/$DataAll->sum('Jumlah')*100, 2)}}@endif</td>
                            <td>%</td>
                        </tr>
                        <tr>
                            <td>Total Harvest</td>
                            <td>:</td>
                            <td>{{$DataAll->sum('JumlahPanen')}}</td>
                            <td>pcs</td>
                        </tr>
                    </table>
                </div>
            </div>            
        </div>
        <div class="col-md-8">  
            <div class="card">
                <div class="card-header text-center">Filter Menu</div>
                <div class="card-body">
                    <form action="{{url('/admin/mylea/report')}}" method="GET"> 
                    <div class="row">
                        <div class="col">
                            <div class="row mb-2">
                                <label for="TanggalAwal" class="col-sm-4 col-form-label col-form-label-sm">Initial Date</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAwal'])){{$_GET['TanggalAwal']}}@endif" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="TanggalAkhir" class="col-sm-4 col-form-label col-form-label-sm">End Date </label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAkhir'])){{$_GET['TanggalAkhir']}}@endif" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="KodeProduksi" class="col-sm-4 col-form-label col-form-label-sm">Production Code </label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <input type="text" name="KodeProduksi" value="@if(isset($_GET['KodeProduksi'])){{$_GET['KodeProduksi']}}@endif" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="Keterangan" class="col-sm-4 col-form-label col-form-label-sm">Notes </label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <input type="text" name="Keterangan" value="@if(isset($_GET['Keterangan'])){{$_GET['Keterangan']}}@endif" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="row mb-2">
                                <label for="JumlahTray" class="col-sm-4 col-form-label col-form-label-sm">Amount of Production </label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-2">
                                    <select name="JumlahTrayOperator" class="form-control">
                                        <option value=">">></option>
                                        <option value="<"><</option>
                                        <option value="=">=</option>
                                        @if(isset($_GET['JumlahTrayOperator']))
                                        <option value="{{$_GET['JumlahTrayOperator']}}" selected>{{$_GET['JumlahTrayOperator']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="JumlahTrayNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['JumlahTrayNumber'])){{$_GET['JumlahTrayNumber']}}@endif">
                                </div>
                            </div> --}}
                            <div class="row mb-2">
                                <label for="InStock" class="col-sm-4 col-form-label col-form-label-sm">Under Incubation </label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-2">
                                    <select name="InStockOperator" class="form-control">
                                        <option value=">">></option>
                                        <option value="<"><</option>
                                        <option value="=">=</option>
                                        @if(isset($_GET['InStockOperator']))
                                        <option value="{{$_GET['InStockOperator']}}" selected>{{$_GET['InStockOperator']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="InStockNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['InStockNumber'])){{$_GET['InStockNumber']}}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- <div class="row mb-2">
                                <label for="Kontaminasi" class="col-sm-4 col-form-label col-form-label-sm">Contamination</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-2">
                                    <select name="KontaminasiOperator" class="form-control">
                                        <option value=">">></option>
                                        <option value="<"><</option>
                                        <option value="=">=</option>
                                        @if(isset($_GET['KontaminasiOperator']))
                                        <option value="{{$_GET['KontaminasiOperator']}}" selected>{{$_GET['KontaminasiOperator']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="KontaminasiNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['KontaminasiNumber'])){{$_GET['KontaminasiNumber']}}@endif">
                                </div>
                            </div> --}}
                            <div class="row mb-2">
                                <label for="Method" class="col-sm-4 col-form-label col-form-label-sm">Method</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <select name="MethodSelected" class="form-control">
                                        <option value="" >Choose Method</option>
                                        <option value="Direct" {{ isset($_GET['MethodSelected']) && $_GET['MethodSelected'] == 'Direct' ? 'selected' : '' }}>Direct</option>
                                        <option value="2 phase" {{ isset($_GET['MethodSelected']) && $_GET['MethodSelected'] == '2 phase' ? 'selected' : '' }}>2 phase</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="Tray" class="col-sm-4 col-form-label col-form-label-sm">Tray</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <select name="TraySelected" class="form-control">
                                        <option value="">Choose Tray</option>
                                        <option value="T0" {{ isset($_GET['TraySelected']) && $_GET['TraySelected'] == 'T0' ? 'selected' : '' }}>T0</option>
                                        <option value="T1" {{ isset($_GET['TraySelected']) && $_GET['TraySelected'] == 'T1' ? 'selected' : '' }}>T1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="SubstrateQty" class="col-sm-4 col-form-label col-form-label-sm">SubstrateQty</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <select name="SubstrateQtySelected" class="form-control">
                                        <option value="">Choose SubstrateQty (kg)</option>
                                        <option value="2" {{ isset($_GET['SubstrateQtySelected']) && $_GET['SubstrateQtySelected'] == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ isset($_GET['SubstrateQtySelected']) && $_GET['SubstrateQtySelected'] == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ isset($_GET['SubstrateQtySelected']) && $_GET['SubstrateQtySelected'] == '4' ? 'selected' : '' }}>4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="Recipe" class="col-sm-4 col-form-label col-form-label-sm">Recipe</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-6">
                                    <select name="RecipeSelected" class="form-control">
                                        <option value="">Choose Recipe </option>
                                        <option value="STP20" {{ isset($_GET['RecipeSelected']) && $_GET['RecipeSelected'] == 'STP20' ? 'selected' : '' }}>STP20</option>
                                        <option value="FTP15" {{ isset($_GET['RecipeSelected']) && $_GET['RecipeSelected'] == 'FTP15' ? 'selected' : '' }}>FTP15</option>
                                        <option value="TTP15" {{ isset($_GET['RecipeSelected']) && $_GET['RecipeSelected'] == 'TTP15' ? 'selected' : '' }}>TTP15</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row mb-2">
                                <label for="PersenKonta" class="col-sm-4 col-form-label col-form-label-sm">Contamination Rate</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-2">
                                    <select name="PersenKontaOperator" class="form-control">
                                        <option value=">">></option>
                                        <option value="<"><</option>
                                        <option value="=">=</option>
                                        @if(isset($_GET['PersenKontaOperator']))
                                        <option value="{{$_GET['PersenKontaOperator']}}" selected>{{$_GET['PersenKontaOperator']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="PersenKontaNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['PersenKontaNumber'])){{$_GET['PersenKontaNumber']}}@endif">
                                </div>
                            </div> --}}
                            {{-- <div class="row mb-2">
                                <label for="Panen" class="col-sm-4 col-form-label col-form-label-sm">Harvest</label>
                                <label class="col-sm-1 col-form-label col-form-label-sm">:</label>
                                <div class="col-sm-2">
                                    <select name="PanenOperator" class="form-control">
                                        <option value=">">></option>
                                        <option value="<"><</option>
                                        <option value="=">=</option>
                                        @if(isset($_GET['PanenOperator']))
                                        <option value="{{$_GET['PanenOperator']}}" selected>{{$_GET['PanenOperator']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="PanenNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['PanenNumber'])){{$_GET['PanenNumber']}}@endif">
                                </div>
                            </div> --}}
                            <div class="row mb-2">
                                <div class="col-sm-11">
                                    <button type="Submit" name="Filter" class="btn btn-primary float-end" value="1" style="width:26vh">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.baglog-table td {
    width: 10%; /* Set td width to 25% of table width */
    min-width: 10%; /* Set td width to 25% of table width */
}
/* style for freeze header */
.sticky-header {
        position: sticky;
        top: 0;
        background-color: #fff; 
        z-index: 1;
        border-color: 1px solid black;
}
.card {
    height: 100%
}
</style>
<section class="m-5">
    {{-- <h3> Production Report</h3>
    <h4> Total In Stock : {{$Data->sum('InStock')}}</h4>
    <h4> Total Panen : {{$Data->sum('JumlahPanen')}}</h4>
    <h4> Total Production : {{$Data->sum('Jumlah')}}</h4>
    <h4> Kontaminasi: {{$Data->sum('Konta')}}</h4>
    <h4> Total Kontaminasi: @if($Data->sum('Jumlah')){{round($Data->sum('Konta')/$Data->sum('Jumlah')*100, 2)}} %@endif</h4>
    --}}
    @if(count($Resume) != 0)
        <h5> Tanggal Awal: {{$Resume['TanggalAwal']}}</h5>
        <h5> Tanggal Akhir: {{$Resume['TanggalAkhir']}}</h5>
        <h5> Total Produksi: {{$Data->sum('Jumlah')}}</h5>
        <h5> Kontaminasi: {{$Data->sum('Konta')}}</h5>
    @endif
    {{-- <div class="col-md-2" style="float: right;">
        <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export Report as .xlsx</button>
      </div>
      <div class="col-md-2 " style="float: right;">
        <button class="btn btn-primary" style="width:35vh; margin-right:100px;" onclick="ExportToExcel2('xlsx')">Export Kontaminasi as .xlsx</button>
      </div> --}}

      <div class="row justify-content-end">
        <div class="col-auto">
            <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export Report as .xlsx</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" onclick="ExportToExcel2('xlsx')">Export Contamination as .xlsx</button>
        </div>
    </div>
    
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="m-2">
        {{-- @include('admin.Mylea.FilterForm') --}}
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <table class="table text-center">
            <tr class="sticky-header">
                <th>@sortablelink('KodeProduksi','Production Code')</th>
                <th>@sortablelink('TanggalProduksi','Production Date')</th>
                <th>@sortablelink('Keterangan','Notes')</th>
                <th>@sortablelink('Jumlah', 'Total Production')</th>
                <th>
                    <form>
                        @if(isset($_GET['KontaDir']))
                            @if($_GET['KontaDir'] == 'ASC')
                                <input type="hidden" name="KontaDir" value="DESC">
                            @else
                                <input type="hidden" name="KontaDir" value="ASC">
                            @endif
                        @else
                            <input type="hidden" name="KontaDir" value="DESC">
                        @endif
                        <input type="submit" name="SubmitKontaDir" value="Contamination" class="btn btn-link">
                        <i class="bi bi-sort-up"></i>
                    </form>
                </th>
                <th>
                    <form>
                        @if(isset($_GET['PersenKontaDir']))
                            @if($_GET['PersenKontaDir'] == 'ASC')
                                <input type="hidden" name="PersenKontaDir" value="DESC">
                            @else
                                <input type="hidden" name="PersenKontaDir" value="ASC">
                            @endif
                        @else
                            <input type="hidden" name="PersenKontaDir" value="DESC">
                        @endif
                        <input type="submit" name="SubmitPersenKontaDir" value="Contamination Rate" class="btn btn-link">
                        <i class="bi bi-sort-up"></i>
                    </form>
                </th>
                <th>
                    <form>
                        @if(isset($_GET['PanenDir']))
                            @if($_GET['PanenDir'] == 'ASC')
                                <input type="hidden" name="PanenDir" value="DESC">
                            @else
                                <input type="hidden" name="PanenDir" value="ASC">
                            @endif
                        @else
                            <input type="hidden" name="PanenDir" value="DESC">
                        @endif
                        <input type="submit" name="SubmitPanenDir" value="Harvest" class="btn btn-link">
                        <i class="bi bi-sort-up"></i>
                    </form>
                </th>
                <th>
                    <form>
                        @if(isset($_GET['InStockDir']))
                            @if($_GET['InStockDir'] == 'ASC')
                                <input type="hidden" name="InStockDir" value="DESC">
                            @else
                                <input type="hidden" name="InStockDir" value="ASC">
                            @endif
                        @else
                            <input type="hidden" name="InStockDir" value="DESC">
                        @endif
                        <input type="submit" name="SubmitInStockDir" value="Under Incubation" class="btn btn-link">
                        <i class="bi bi-sort-up"></i>
                    </form>
                </th>
                <th>Harvest Schedule</th>
                <th>Method</th>
                <th>Tray</th>
                <th>Substrate Qty (kg)</th>
                <th>
                    <table class="table table-borderless baglog-table text-center">
                        <tr class="sticky-header">
                            <td colspan="7">Substrate Bag</td>
                            <td>Total Conta</td>
                            <td>% Conta</td>
                            {{-- <td>Harvest Schedule</td> --}}
                            <td>Total Harvest</td>
                        </tr>
                        <tr class="sticky-header">
                            <td>Substrate Bag Code</td>
                            <td>Type</td>
                            <td>Substrate Bag Qty</td>
                            <td>Spawn Batch</td>
                            <td>Spawn Code</td>
                            <td>Spawn Age (Day)</td>
                            <td>Substrate Bag Age (Week)</td>
                        </tr>
                    </table>
                </th>

            </tr>
            @foreach ($Data as $data)
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['Keterangan']}}</td>
                    <td>{{$data['Jumlah']}}</td>
                    @if ($data['Konta'] > 0)
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#KontaminasiModal{{$data['id']}}" data-bs-dismiss="modal">  {{ $data['Konta'] }}</a>
                            @include('admin.Mylea.KontaminasiPartial') 
                        </td>
                    @else
                        <td>
                            {{ $data['Konta'] }}
                        </td>
                    @endif
                    <td>{{round($data['Konta']/$data['Jumlah']*100, 2)}}%</td>
                    @if ($data['JumlahPanen'] > 0)
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#PanenModal{{$data['id']}}">{{ $data['JumlahPanen'] }}</a>
                            @include('admin.Mylea.PanenPartial') 
                        </td>
                    @else
                        <td>0</td>
                    @endif
                    <td>{{$data['InStock']}}</td>

                    @php
                    $LastKodeProduksi = substr($data['KodeProduksi'], -1);

                    $I3 = substr($data['KodeProduksi'], 11);
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
                @endphp
                    <td>{{ $result }}</td>
                    
                    <td>{{ $data['Method'] }}</td>
                    <td>{{ $data['Tray'] }}</td>
                    <td>{{ $data['SubstrateQty'] }}</td>
                    <td>
                        <table class="table-borderless table text-center baglog-table">
 
                            @foreach($data['DataBaglog'] as $DataBaglog)

                            @if( (!isset($_GET['RecipeSelected'])) || ($_GET['RecipeSelected'] == "") || $DataBaglog['Type'] === $_GET['RecipeSelected'])
                                <tr>
                                    @if(substr($DataBaglog['KPBaglog'], 0, 2) != 'BL')
                                        <td colspan="6" style="width: 49%" >{{$DataBaglog['KPBaglog']}}</td>
                                    @else
                                    <td>
                                        <a href="{{url('/admin/baglog/report?TanggalAwal=&TanggalAkhir=&SearchQuery='.$DataBaglog['KPBaglog'].'&Submit=Search')}}">{{$DataBaglog['KPBaglog']}}</a>
                                    </td>
                                    <td>{{ $DataBaglog['Type'] }}</td>
                                    <td style= "width:7%">{{$DataBaglog['JumlahBaglog']}}</td>
                                    <td style= "width:7%">{{$DataBaglog['BatchBibitTerpakai']}} </td>
                                    <td style="width:7%">{{substr($DataBaglog['KPBaglog'], 11)}} </td>
                                    <td style="width:7%">{{$DataBaglog['UmurBibit']}}</td>
                                    <td>{{$DataBaglog['UmurBaglog']}}</td>
                                    @endif
                                    @php
                                        $LastKodeProduksi = substr($data['KodeProduksi'], -1);
                                        $DataBaglog['Konta'] = $data['DataKontaminasi']->where('KPBaglog', $DataBaglog['KPBaglog']);
                                        $DataBaglog['Panen'] = $data['PanenBaglog']->where('KPBaglog', $DataBaglog['KPBaglog']);
                                        foreach($DataBaglog['Konta'] as $konta){
                                            $DataBaglog['TanggalKonta'] = $DataBaglog['TanggalKonta'].$konta['TanggalKontaminasi'].',';
                                        }

                                        foreach($DataBaglog['Panen'] as $Panen){
                                            $DataBaglog['TanggalPanen'] = $DataBaglog['TanggalPanen'].$Panen['TanggalPanen'].',';
                                        }


                                        if($DataBaglog['TanggalKonta'] == null){
                                            $DataBaglog['TanggalKonta'] = '0000-00-00';
                                        }
                                        if($DataBaglog['TanggalPanen'] == null){
                                            $DataBaglog['TanggalPanen'] = '0000-00-00';
                                        }

                                        $I3 = substr($DataBaglog['KodeProduksi'], 11);
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
                                    @endphp
                                    <td>{{ $DataBaglog['Konta']->sum('Jumlah') }}</td>
                                    <td style="width:7%">{{round($DataBaglog['Konta']->sum('Jumlah')/$data['Jumlah']*100, 2)}}%</td>
                                    {{-- <td>{{ $result }}</td> --}}
                                    <td>{{$DataBaglog['Panen']->sum('Jumlah')}}</td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </td>
             

                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#BaglogModal{{$data['id']}}" data-bs-dismiss="modal">
                            Data Baglog
                        </button>
                        @include('admin.Mylea.BaglogPartial') 
                    </td> --}}
                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#KontaminasiModal{{$data['id']}}" data-bs-dismiss="modal">
                            Data Kontaminasi
                        </button>
                        @include('admin.Mylea.KontaminasiPartial') 
                    </td> --}}
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ElusModal{{$data['id']}}" data-bs-dismiss="modal">
                            Data Elus
                        </button>
                        @include('admin.Mylea.ElusPartial') 
                    </td>
                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PanenModal{{$data['id']}}">
                            Data Panen
                        </button>
                        @include('admin.Mylea.PanenPartial') 
                    </td> --}}
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal{{$data['id']}}">
                            Edit
                        </button>
                        @include('admin.Mylea.EditPartial') 
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DeleteModal{{$data['id']}}">
                            Delete
                        </button>
                        @include('admin.Mylea.DeleteConfirmPartial') 
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
         </div>

    <!--Export Kontam-->
    <div style="display:none;">
        <table class="table text-center" id="tbl_exporttable_to_xls2">
            <tr>
                <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
                <th>@sortablelink('TanggalProduksi','Tanggal Produksi')</th>
                <th>Hari Produksi</th>
                <th>@sortablelink('Jumlah', 'Jumlah Tray')</th>
                <th>Kontaminasi</th>
                <th>Total Kontaminasi (%)</th>
                <th colspan="2">Elus 1</th>
                <th colspan="2">Elus 2</th>
                <th colspan="2">Elus 3</th>
                <th colspan="2">Elus 4</th>
                <th colspan="2">Elus 5</th>
                <th colspan="2">Elus 6</th>
                <th colspan="2">Elus 7</th>
                <th colspan="2">Elus 8</th>
                <th colspan="2">Elus 9</th>
                <th colspan="2">Elus 10</th>
                <th colspan="2">Elus 11</th>
                <th colspan="2">Elus 12</th>
            </tr>
            
            @foreach ($Data as $data)
                @php
                    
                    $TanggalProduksi = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+0 days"));
                    $dayOfWeek = date("l", strtotime($TanggalProduksi));

                    switch ($dayOfWeek) {
                    case "Monday":
                        $Elus['1'] = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+7 days"));
                        $Elus['2']= date("Y-m-d", strtotime("next Thursday", strtotime($Elus['1'])));
                        $Elus['3'] = date("Y-m-d", strtotime("next Monday", strtotime($Elus['1'])));
                        break;
                    case "Tuesday":
                        $Elus['1'] = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+6 days"));
                        $Elus['2']= date("Y-m-d", strtotime("next Friday", strtotime($Elus['1'])));
                        $Elus['3'] = date("Y-m-d", strtotime("next Monday", strtotime($Elus['1'])));
                        break;
                    case "Wednesday":
                        $Elus['1'] = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+6 days"));
                        $Elus['2']= date("Y-m-d", strtotime("next Monday", strtotime($Elus['1'])));
                        $Elus['3'] = date("Y-m-d", strtotime("next Thursday", strtotime($Elus['2'])));
                        break;
                    case "Thursday":
                        $Elus['1'] = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+7 days"));
                        $Elus['2']= date("Y-m-d", strtotime("next Monday", strtotime($Elus['1'])));
                        $Elus['3'] = date("Y-m-d", strtotime("next Thursday", strtotime($Elus['1'])));
                        break;
                    case "Friday":
                        $Elus['1'] = date("Y-m-d", strtotime($data['TanggalProduksi'] . "+7 days"));
                        $Elus['2']= date("Y-m-d", strtotime("next Monday", strtotime($Elus['1'])));
                        $Elus['3'] = date("Y-m-d", strtotime("next Friday", strtotime($Elus['1'])));
                        break;
                    }

                    $KontaElus['1'] = $data['DataKontaminasi']->where('TanggalKontaminasi', $Elus['1'])->sum('Jumlah');
                    $KontaElus['2'] = $data['DataKontaminasi']->where('TanggalKontaminasi', $Elus['2'])->sum('Jumlah');
                    $KontaElus['3'] = $data['DataKontaminasi']->where('TanggalKontaminasi', $Elus['3'])->sum('Jumlah');
                    
                    for($i = 4; $i < 13; $i++){
                        $x= $i-2;
                        $Elus[$i] = date("Y-m-d", strtotime($Elus[$x]. "+7 days"));
                        $KontaElus[$i] = $data['DataKontaminasi']->where('TanggalKontaminasi', $Elus[$i])->sum('Jumlah');
                    }

                @endphp
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$dayOfWeek}}</td>
                    <td>{{$data['Jumlah']}}</td>
                    <td>{{$data['Konta']}}</td>
                    <td>{{round($data['Konta']/$data['Jumlah']*100, 2)}}</td>
                    <td>{{$Elus['1']}}</td>
                    <td>{{$KontaElus['1']}}</td>
                    <td>{{$Elus['2']}}</td>
                    <td>{{$KontaElus['2']}}</td>
                    <td>{{$Elus['3']}}</td>
                    <td>{{$KontaElus['3']}}</td>
                    <td>{{$Elus['4']}}</td>
                    <td>{{$KontaElus['4']}}</td>
                    <td>{{$Elus['5']}}</td>
                    <td>{{$KontaElus['5']}}</td>
                    <td>{{$Elus['6']}}</td>
                    <td>{{$KontaElus['6']}}</td>
                    <td>{{$Elus['7']}}</td>
                    <td>{{$KontaElus['7']}}</td>
                    <td>{{$Elus['8']}}</td>
                    <td>{{$KontaElus['8']}}</td>
                    <td>{{$Elus['9']}}</td>
                    <td>{{$KontaElus['9']}}</td>
                    <td>{{$Elus['10']}}</td>
                    <td>{{$KontaElus['10']}}</td>
                    <td>{{$Elus['11']}}</td>
                    <td>{{$KontaElus['11']}}</td>
                    <td>{{$Elus['12']}}</td>
                    <td>{{$KontaElus['12']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <!--Export Scripts-->
    <div style="display:none;">
    <table class="table" id="tbl_exporttable_to_xls">
      @if(count($Resume) != 0)
        <tr>
            <td colspan="2">Resume</td>
        </tr>
        <tr>
          <td> Tanggal Awal: </td>
          <td>{{$Resume['TanggalAwal']}}</td>
        </tr>
        <tr>
          <td> Tanggal Akhir: </td>
          <td>{{$Resume['TanggalAkhir']}}</td>
        </tr>
        <tr>
          <td> Total Produksi: </td>
          <td>{{$Data->sum('Jumlah')}}</td>
        </tr>
        <tr>
          <td> Kontaminasi: </td>
          <td>{{$Data->sum('Konta')}}</td>
        </tr>
        <tr></tr>
      @endif
      <tr>
        <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
        <th>@sortablelink('TanggalProduksi','Tanggal Produksi')</th>
        <th>@sortablelink('Jumlah', 'Jumlah Tray')</th>
        <th>Kontaminasi</th>
        <th>Total Kontaminasi (%)</th>
        <th>Panen</th>
        <th>In Stock</th>
        <th>Kode Substrate Bag</th>
        <th>Jumlah Substrate Bag</th>
        <th>Batch Bibit</th>
        <th>Jenis Bibit</th>
        <th>Umur Bibit</th>
        <th>Umur Substrate Bag</th>
        <th>Tanggal Konta</th>
        <th>Jumlah Konta</th>
        <th>% Konta</th>
        <th>Jadwal Panen</th>
        <th>Tanggal Panen</th>
        <th>Jumlah Panen</th>

    </tr>
    @foreach ($Data as $data)
        <tr>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['KodeProduksi']}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['TanggalProduksi']}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['Jumlah']}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['Konta']}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{round($data['Konta']/$data['Jumlah']*100, 2)}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['JumlahPanen']}}</td>
                    <td rowspan="{{count($data['DataBaglog']) + 1}}">{{$data['InStock']}}</td>
        </tr>
        @foreach($data['DataBaglog'] as $DataBaglog)
        <tr>
            <td><a href="{{url('/admin/baglog/report?TanggalAwal=&TanggalAkhir=&SearchQuery='.$DataBaglog['KPBaglog'].'&Submit=Search')}}">{{$DataBaglog['KPBaglog']}}</a></td>
            <td>{{$DataBaglog['JumlahBaglog']}}</td>
            <td>{{$DataBaglog['BatchBibitTerpakai']}}</td>
            <td>{{substr($DataBaglog['KPBaglog'], 11)}}</td>
            <td>{{$DataBaglog['UmurBibit']}}</td>
            <td>{{$DataBaglog['UmurBaglog']}}</td>
            @php
                $DataBaglog['Konta'] = $data['DataKontaminasi']->where('KPBaglog', $DataBaglog['KPBaglog']);
                $DataBaglog['Panen'] = $data['PanenBaglog']->where('KPBaglog', $DataBaglog['KPBaglog']);
                foreach($DataBaglog['Konta'] as $konta){
                    $DataBaglog['TanggalKonta'] = $DataBaglog['TanggalKonta'].$konta['TanggalKontaminasi'].',';
                }

                foreach($DataBaglog['Panen'] as $Panen){
                    $DataBaglog['TanggalPanen'] = $DataBaglog['TanggalPanen'].$Panen['TanggalPanen'].',';
                }


                if($DataBaglog['TanggalKonta'] == null){
                    $DataBaglog['TanggalKonta'] = '0000-00-00';
                }
                if($DataBaglog['TanggalPanen'] == null){
                    $DataBaglog['TanggalPanen'] = '0000-00-00';
                }

                $I3 = substr($DataBaglog['KodeProduksi'], 11);
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
            @endphp
            <td>{{$DataBaglog['TanggalKonta']}}</td>
            <td>{{$DataBaglog['Konta']->sum('Jumlah')}}</td>
            <td>{{round($DataBaglog['Konta']->sum('Jumlah')/$data['Jumlah']*100, 2)}}</td>
            <td>{{date("D", strtotime($A3))." ".$result}}</td>
            <td>{{$DataBaglog['TanggalPanen']}}</td>
            <td>{{$DataBaglog['Panen']->sum('Jumlah')}}</td>
        </tr>
        @endforeach
    @endforeach
    </table>
  </div>
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  @if(isset($_GET['TanggalAwal']))
  <script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_exporttable_to_xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('ReportMylea_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
        }  
    function ExportToExcel2(type, fn, dl) {
        var elt = document.getElementById('tbl_exporttable_to_xls2');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('ReportKontaminasiMylea_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
    }  
  </script>
  @endif
  
</section>
@endsection