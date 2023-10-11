@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/post-treatment')}}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
    </nav>
  </div>


<section class="m-5">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <h3>Report</h3>
    @if(count($Resume) != 0)
        <h5> Tanggal Awal: {{$Resume['TanggalAwal']}}</h5>
        <h5> Tanggal Akhir: {{$Resume['TanggalAkhir']}}</h5>
    @endif
    <div class="col-md-4 " style="float: right;">
        <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export as .xlsx</button>
      </div>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <form action="{{url('/admin/post-treatment/report')}}" method="GET">
        <p>
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Filter
          </a>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="row mb-3 ">
              <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAwal') }}">
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAkhir') }}">
              </div>
          </div>
          <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
          </div>
        </div>
      
        <div class="input-group mb-3" style="width:250px">
          <input type="text" name="SearchQuery" placeholder="Search..." value="{{ old('SearchQuery') }}" class="form-control">
          <div class="input-group-append">
            <input name="Submit" type="submit" value="Search" class="btn btn-outline-primary">
          </div>
        </div>
        </form>

        <div>
          <?php
              $RejectRebus = 0;
              $RejectScouring = 0;
              $RejectTingi = 0;
              $RejectFerroSulfat = 0;
              $RejectFatLiquor = 0;
              $RejectFixing = 0;
              $RejectPEG = 0;
              $RejectDrying = 0;
              $RejectReinforceRollPress = 0;
              $RejectAmplas = 0;
              $RejectClearing = 0;
              $RejectStuccofilling = 0;
              $RejectCoating1 = 0;
              $RejectCoating2 = 0;
              $RejectCoating3 = 0;
              $RejectPlatingTokonole = 0;
              $TotalReject  = 0;
              foreach ($Data->unique('PostID') as $data){
                $RejectRebus = $RejectRebus + ($data['Proses']->where('Proses','Rebus')->sum('Reject'));
                $RejectScouring =  $RejectScouring + ($data['Proses']->where('Proses','Scouring')->sum('Reject'));
                $RejectTingi =  $RejectTingi + ($data['Proses']->where('Proses','Tingi')->sum('Reject'));
                $RejectFerroSulfat =  $RejectFerroSulfat + ($data['Proses']->where('Proses','Ferro Sulfat')->sum('Reject'));
                $RejectFatLiquor =  $RejectFatLiquor + ($data['Proses']->where('Proses','Fat Liquor')->sum('Reject'));
                $RejectFixing += $data['Proses']->where('Proses','Fixing')->sum('Reject');
                $RejectPEG += $data['Proses']->where('Proses','PEG')->sum('Reject');
                $RejectDrying += $data['Proses']->where('Proses','Drying')->sum('Reject');
                $RejectReinforceRollPress += $data['Proses']->where('Proses','Reinforce + Roll Press')->sum('Reject');
                $RejectAmplas += $data['Proses']->where('Proses','Amplas')->sum('Reject');
                $RejectClearing += $data['Proses']->where('Proses','Clearing')->sum('Reject');
                $RejectStuccofilling += $data['Proses']->where('Proses','Stucco + filling')->sum('Reject');
                $RejectCoating1 += $data['Proses']->where('Proses','Coating 1')->sum('Reject');
                $RejectCoating2 += $data['Proses']->where('Proses','Coating 2')->sum('Reject');
                $RejectCoating3 += $data['Proses']->where('Proses','Coating 3')->sum('Reject');
                $RejectPlatingTokonole += $data['Proses']->where('Proses','Plating + Tokonole')->sum('Reject');

                $TotalReject += $data['Proses']->sum('Reject');
              }
          ?>
          <h3>Resume</h3>
          <h4>Total Diproses : {{$Data->unique('PostID')->sum('JumlahAwal')}}</h4>
          <h4>In Stock : {{$Data->unique('PostID')->sum('JumlahAwal') - $TotalReject}}</h4>
          <h4>Total Reject Per Proses :</h4>
          <div class="table-responsive-xl">
            <table class="table">
              <tr>
                <th>Rebus</th>
                <th>Scouring</th>
                <th>Tingi</th>
                <th>Ferro Sulfat</th>
                <th>Fat Liquor</th>
                <th>Fixing</th>
                <th>PEG</th>
                <th>Drying</th>
                <th>Reinforce + Roll Press</th>
                <th>Amplas</th>
                <th>Clearing</th>
                <th>Stucco + filling</th>
                <th>Coating 1</th>
                <th>Coating 2</th>
                <th>Coating 3</th>
                <th>Plating + Tokonole</th>
              </tr>
              <tr>
                <td>{{$RejectRebus}}</td>
                <td>{{$RejectScouring}}</td>
                <td>{{$RejectTingi}}</td>
                <td>{{$RejectFerroSulfat}}</td>
                <td>{{$RejectFatLiquor}}</td>
                <td>{{$RejectFixing}}</td>
                <td>{{$RejectPEG}}</td>
                <td>{{$RejectDrying}}</td>
                <td>{{$RejectReinforceRollPress}}</td>
                <td>{{$RejectAmplas}}</td>
                <td>{{$RejectClearing}}</td>
                <td>{{$RejectStuccofilling}}</td>
                <td>{{$RejectCoating1}}</td>
                <td>{{$RejectCoating2}}</td>
                <td>{{$RejectCoating3}}</td>
                <td>{{$RejectPlatingTokonole}}</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="table-responsive-xl">
          <table class="table w-auto">
            <thead class= "sticky-header">
              <tr>
                  <th>Batch</th>
                  <th >Mylea</th>
                  <th>Jumlah</th>
                  <th>Total Reject</th>
                  <th>Rebus</th>
                  <th>Scouring</th>
                  <th>Tingi</th>
                  <th>Ferro Sulfat</th>
                  <th>Fat Liquor</th>
                  <th>Fixing</th>
                  <th>PEG</th>
                  <th>Drying</th>
                  <th>Reinforce + Roll Press</th>
                  <th>Amplas</th>
                  <th>Clearing</th>
                  <th>Stucco + filling</th>
                  <th>Coating 1</th>
                  <th>Coating 2</th>
                  <th>Coating 3</th>
                  <th>Plating + Tokonole</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Data->unique('PostID') as $data)
                  <tr>
                      <td>{{$data['Batch']."/".$data['Tanggal']}}</td>
                      <td>
                        <table>
                            @foreach($data['Mylea'] as $item)
                            <tr>
                              <td style="max-width:100%; white-space:nowrap;">
                                {{$item['KPMylea']}}
                              </td>
                            </tr>
                            @endforeach
                        </table>
                      </td>
                      <td>{{$data['JumlahAwal']}}</td>
                      <td>{{$data['Proses']->sum('Reject')}}</td>
                      <td>{{$data['Proses']->where('Proses','Rebus')->sum('Jumlah')}}/{{$data['JumlahAwal']}}</td>
                      <td>{{$data['Proses']->where('Proses','Scouring')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Rebus')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Tingi')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Scouring')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Ferro Sulfat')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Ferro Sulfat')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Fat Liquor')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Ferro Sulfat')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Fixing')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Fat Liquor')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','PEG')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Fixing')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Drying')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','PEG')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Reinforce + Roll Press')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Drying')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Amplas')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Reinforce + Roll Press')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Clearing')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Amplas')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Stucco + filling')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Clearing')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Coating 1')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Stucco + filling')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Coating 2')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Coating 1')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Coating 3')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Coating 2')->sum('Jumlah')}}</td>
                      <td>{{$data['Proses']->where('Proses','Plating + Tokonole')->sum('Jumlah')}}/{{$data['Proses']->where('Proses','Coating 3')->sum('Jumlah')}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
      <div class="d-flex justify-content-center">
          {!! $Data->links() !!}
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
          <tr></tr>
        @endif
        <tr>
          <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
          <th>@sortablelink('TanggalProduksi','Tanggal Produksi')</th>
          <th>@sortablelink('Jumlah')</th>
          <th>Kontaminasi</th>
          <th>Panen</th>
          <th>In Stock</th>
      </tr>
      @foreach ($Data as $data)
          <tr>
              <td>{{$data['KodeProduksi']}}</td>
              <td>{{$data['TanggalProduksi']}}</td>
              <td>{{$data['Jumlah']}}</td>
              <td>{{$data['Konta']}}</td>
              <td>{{$data['JumlahPanen']}}</td>
              <td>{{$data['InStock']}}</td>
          </tr>
      @endforeach
      </table>
    </div>
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
  </script>
  @endif
</section>

<style>
/* style for freeze header */
.sticky-header {
        position: sticky;
        top: 0;
        background-color: #fff; 
        z-index: 1;
        border-color: 1px solid black;
}
</style>
@endsection