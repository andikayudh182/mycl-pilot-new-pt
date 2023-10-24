@extends('layouts.admin')
@php
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
@endphp

<style>
  /* .tableFixHead {
    overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
    /* height: 200vh;  */
  /* } */
  /* .tableFixHead thead th { */
          /* position: sticky; make the table heads sticky */
          /* top: 0px; table head will be placed from the top of the table and sticks to it */
  /* } */
  table {
    border-collapse: collapse; /* make the table borders collapse to each other */
    width: 100%;
  }
  th,
  td {
    padding: 8px 16px;
    border: 1px solid #ccc;
  }
  th {
    background: #eee;
  }

  /* style for freeze header */
  .sticky-header {  
        position: sticky;
        top: 0;
        background-color:white; 
        z-index: 1;
        border-color: 1px solid black;
  } 

</style>

@section('content')
<div class="m-5">
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background-color: white">
          <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Subsrate Bag</a></li>
          <li class="breadcrumb-item active" aria-current="page">Report</li>
      </ol>
  </nav>
</div>

<section class="m-5">
  <div class="row align-items-start">
      <div class="col-4">
        <a href="{{url('/admin/baglog/report-pengayakan')}}">Data Pengayakan</a>
      </div>
      <div class="col-4">
          <a href="{{url('/admin/baglog/report-mixing')}}">Data Mixing</a>
      </div>
      <div class="col-4">
          <a href="{{url('/admin/baglog/report-sterilisasi')}}">Data Sterilisasi</a>
      </div>
  </div>
</section>

<section class="m-5">
  <h4>Total In Stock : {{$TotalInStock}}</h4>
  @if(count($Resume) != 0)
    <h5> Tanggal Awal: {{$Resume['TanggalAwal']}}</h5>
    <h5> Tanggal Akhir: {{$Resume['TanggalAkhir']}}</h5>
    <h5> Total Produksi: {{$Resume['TotalProduksi']->sum('JumlahBaglog')}}</h5>
    <h5> Kontaminasi: {{$Resume['Kontaminasi']->sum('JumlahKonta')}}</h5>
  @endif
  <div class="col-md-4 " style="float: right;">
    <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export as .xlsx</button>
  </div>
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
  @endif
  <form action="{{url('/admin/baglog/report')}}" method="GET">
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
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <div class="tableFixHead">
    <table class="table">
      <thead class="sticky-header" >
        <tr>
          <th>
              <table class="table-borderless table text-center">
                <tr class="sticky-header">
                  <th colspan="4">Mixing</th>
                </tr>
                <tr>
                  <th width="25%">Tanggal</th>
                  <th width="25%">Jumlah</th>
                  <th width="25%">No Karung</th>
                  <th width="25%">MC Serbuk Kayu</th>
                </tr>
              </table>
          </th>
          <th>
              <table class="table-borderless table text-center">
                <tr>
                  <th colspan="2">Sterilisasi</th>
                </tr>
                <tr>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                </tr>
              </table>
          </th>
          <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
          <th>@sortablelink('TanggalPengerjaan','Tanggal Pengerjaan')</th>
          <th>@sortablelink('JumlahBaglog','Jumlah Substrate Bag')</th>
          <th>
            <table class="table-borderless table text-center">
              <tr>
                <th colspan="4">Bibit Dipakai</th>
              </tr>
              <tr>
                <th>Jumlah</th>
                <th>Batch</th>
                <th>Jenis</th>
                <th>Umur Bibit</th>
              </tr>
            </table>
          </th>
          <th>
            <table class="table-borderless table text-center">
              <tr>
                <th colspan="2">Kontaminasi</th>
              </tr>
              <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
              </tr>
            </table>
          </th>
          <th>
            <table class="table-borderless table text-center">
              <tr>
                <th colspan="2">Mylea</th>
              </tr>
              <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
              </tr>
            </table>
          </th>
          <th>Pemakaian Mylea/Panen</th>
          <th>Jumlah Kontaminasi</th>
          <th>Contamination Rate</th>
          <th>In Stock</th>
          <th>Status</th>
          <th colspan="6" class="text-center"> Aksi</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($data as $data1)

          <tr>
            <td>
                <table class="table-borderless table text-center" id="mixing">
                    <?php
                      $dat;
                      $dat = Sterilisasi::select(['baglog_mixing.*', 'baglog_resep.NoKarungSKayu', 'baglog_resep.MCSKayu'])
                      ->join('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.mixing_id')
                      ->join('baglog_resep', 'baglog_resep.id', '=', 'baglog_mixing.resep_id')
                      ->where('baglog_sterilisasi.id', $data1['Sterilisasi'])
                      ->get()->first();
                    ?>
                  <tr>
                      <td><a href="#">@php if(isset($dat)){ echo $dat['TanggalPengerjaan'];} @endphp</a></td>
                      <td>@php if(isset($dat)){ echo $dat['JumlahBaglog'];} @endphp</td>
                      <td>@php if(isset($dat)){ echo $dat['NoKarungSKayu'];} @endphp</td>
                      <td>@php if(isset($dat)){ echo $dat['MCSKayu'];} @endphp</td>
                  </tr>
                </table>
            </td>
            <td>
                <table class="table-borderless table text-center" id="sterilisasi">
                  @foreach($data1['Sterilisasi'] as $item)
                    <?php
                      $dat = Sterilisasi::where('baglog_sterilisasi.id', $item)
                      ->get()->first();
                    ?>
                    <tr>
                      <td>{{$dat['TanggalPengerjaan']}}</td>
                      <td>{{$dat['JumlahBaglog']}}</td>
                    </tr>
                  @endforeach
                </table>
            </td>
            <td>{{$data1['KodeProduksi']}}</td>
            <td>{{$data1['TanggalPengerjaan']}}</td>
            <td>{{$data1['JumlahBaglog']}}</td>
            <td>
              <table class="table-borderless table text-center" id="bibit">
                <tr>
                  <td>{{$data1['BibitTerpakai']}}</td>
                  <td>{{$data1['BatchBibitTerpakai']}}</td>
                  <td>{{substr($data1['KodeProduksi'], 11)}}</td>
                  <td>{{$data1['UmurBibit']}}</td>
                </tr>
              </table>
            </td>
            <td>
              <table class="table-borderless table text-center" id="Kontaminasi">
                <tr>
                  <td width="50%">
                    @foreach($data1['Kontaminasi'] as $item)
                      {{$item['TanggalKonta'].", "}}
                    @endforeach
                  </td>
                  <td width="50%">{{$data1['Kontaminasi']->sum('JumlahKonta')}}</td>
                </tr>
              </table>
            </td>
            <td>
              <table class="table-borderless table text-center" id="Kontaminasi">
                <tr>
                  <td width="50%">
                    @foreach($data1['mylea'] as $item)
                      <a href="{{url('/admin/mylea/report?TanggalAwal=&TanggalAkhir=&SearchQuery='.$item['KPMylea'].'&Submit=Search')}}">{{substr($item['KPMylea'], 6).", "}}</a><br>
                    @endforeach
                  </td>
                  <td width="50%">{{$data1['mylea']->sum('JumlahBaglog')}}</td>
                </tr>
              </table>
            </td>
            <td>{{$data1['mylea']->sum('JumlahBaglog')}}</td>
            <td>{{$data1['Kontaminasi']->sum('JumlahKonta')}}</td>
            <td>{{$data1['PersenKonta']}}%</td>
            <td>{{$data1['InStock']}}</td>
            <td>{{$data1['StatusArchiveLabel']}}</td>
            <td>
              <a href="#" data-bs-toggle="modal" data-bs-target="#SterilisasiModal{{$data1['id']}}" data-bs-dismiss="modal">Data Sterilisasi</a>
              @include('admin.Baglog.DataSterilisasiPembibitanPartial')
            </td>
            <td><a href="{{ route('BaglogKonta', ['KodeProduksi'=>$data1['KodeProduksi'],])}}">Data Kontaminasi</a></td>
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data1['id']}}">Data Crushing</a></td>
            @include('admin.Baglog.EditCrushingPartial')
            <td>
              <a href="#" data-bs-toggle="modal" data-bs-target="#BaglogMyleaModal{{$data1['id']}}" data-bs-dismiss="modal">
                  Data Mylea
              </a>
              @include('admin.Baglog.BaglogMyleaPartial') 
            </td>
            <td><a href="{{ route('BaglogDetails', ['KodeProduksi'=>$data1['KodeProduksi'],])}}">Details</a></td>
          <td><a href="{{ route('DeletePembibitan', ['id'=>$data1['id'],])}}">Delete</a></td>
          </tr>
      @endforeach
      </tbody>
    </table>
  </div>

    <div class="d-flex justify-content-center">
      {!! $data->links() !!}
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
          <td>{{$Resume['TotalProduksi']->sum('JumlahBaglog')}}</td>
        </tr>
        <tr>
          <td> Kontaminasi: </td>
          <td>{{$Resume['Kontaminasi']->sum('JumlahKonta')}}</td>
        </tr>
        <tr></tr>
      @endif
      <thead>
        <tr>
          <th width="25%">Tanggal Mixing</th>
          <th width="25%">Jumlah Mixing</th>
          <th width="25%">No Karung</th>
          <th width="25%">MC Serbuk Kayu</th>
          <th>Tanggal Sterilisasi</th>
          <th>Jumlah Sterilisasi</th>
          </th>
          <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
          <th>@sortablelink('TanggalPengerjaan','Tanggal Pengerjaan')</th>
          <th>@sortablelink('JumlahBaglog','Jumlah Baglog')</th>
          <th>Jumlah Bibit</th>
          <th>Batch Bibit</th>
          <th>Jenis Bibit</th>
          <th>Umur Bibit</th>
          <th>Tanggal Kontaminasi</th>
          <th>Jumlah Kontaminasi</th>
          <th>Tanggal Mylea</th>
          <th>Jumlah Mylea</th>
          <th>Pemakaian Mylea/Panen</th>
          <th>Jumlah Kontaminasi</th>
          <th>Contamination Rate</th>
          <th>In Stock</th>
          <th>Status</th>
      </thead>
      <tbody>
      @foreach ($data as $data1)

          <tr>
            <?php
              $dat;
              $dat = Sterilisasi::select(['baglog_mixing.*', 'baglog_resep.NoKarungSKayu', 'baglog_resep.MCSKayu'])
              ->join('baglog_mixing', 'baglog_mixing.id', '=', 'baglog_sterilisasi.mixing_id')
              ->join('baglog_resep', 'baglog_resep.id', '=', 'baglog_mixing.resep_id')
              ->where('baglog_sterilisasi.id', $data1['Sterilisasi'])
              ->get()->first();
            ?>
            <td><a href="#">@php if(isset($dat)){ echo $dat['TanggalPengerjaan'];} @endphp</a></td>
            <td>@php if(isset($dat)){ echo $dat['JumlahBaglog'];} @endphp</td>
            <td>@php if(isset($dat)){ echo $dat['NoKarungSKayu'];} @endphp</td>
            <td>@php if(isset($dat)){ echo $dat['MCSKayu'];} @endphp</td>
            @php
              $TanggalPengerjaan = '';
              $JumlahBaglog = 0;
            @endphp
            @foreach($data1['Sterilisasi'] as $item)
              <?php
                $dat = Sterilisasi::where('baglog_sterilisasi.id', $item)
                ->get()->first();

                $TanggalPengerjaan = $TanggalPengerjaan.$dat['TanggalPengerjaan'].', ';
                $JumlahBaglog = $JumlahBaglog + $dat['JumlahBaglog'];
              ?>
            @endforeach
            <td>{{$TanggalPengerjaan}}</td>
            <td>{{$JumlahBaglog}}</td>
            <td>{{$data1['KodeProduksi']}}</td>
            <td>{{$data1['TanggalPengerjaan']}}</td>
            <td>{{$data1['JumlahBaglog']}}</td>
            <td>{{$data1['BibitTerpakai']}}</td>
            <td>{{$data1['BatchBibitTerpakai']}}</td>
            <td>{{substr($data1['KodeProduksi'], 11)}}</td>
            <td>{{$data1['UmurBibit']}}</td>
            <td width="50%">
              @foreach($data1['Kontaminasi'] as $item)
                {{$item['TanggalKonta'].", "}}
              @endforeach
            </td>
            <td width="50%">{{$data1['Kontaminasi']->sum('JumlahKonta')}}</td>
            <td width="50%">
              @foreach($data1['mylea'] as $item)
                <a href="{{url('/admin/mylea/report?TanggalAwal=&TanggalAkhir=&SearchQuery='.$item['KPMylea'].'&Submit=Search')}}">{{substr($item['KPMylea'], 6).", "}}</a><br>
              @endforeach
            </td>
            <td width="50%">{{$data1['mylea']->sum('JumlahBaglog')}}</td>
            <td>{{$data1['mylea']->sum('JumlahBaglog')}}</td>
            <td>{{$data1['Kontaminasi']->sum('JumlahKonta')}}</td>
            <td>{{$data1['PersenKonta']}}%</td>
            <td>{{$data1['InStock']}}</td>
            <td>{{$data1['StatusArchiveLabel']}}</td>
          </tr>
      @endforeach
      </tbody>
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
            XLSX.writeFile(wb, fn || ('ReportBaglog_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
        }  
  </script>
  @endif
</section>
@endsection