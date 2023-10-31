@extends('layouts.admin')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
                <li class="breadcrumb-item active" aria-current="page">Harvest Schedule</li>
            </ol>
        </nav>
    </div>
    <section class="body m-5">
        <center><h2>Harvest Schedule</h2></center>
        @php
            use Carbon\Carbon;
            $date = Carbon::Now();
            $PanenDate = substr($date, 0, 7);
            if(isset($_GET['TanggalPanen'])){
                $PanenDate = $_GET['TanggalPanen'];
            }
        @endphp
        <div>
            <form method="GET" action="">
                <div class="row mb-3">
                    <label for="TanggalPanen" class="col-sm-0 col-form-label col-form-label-sm"></label>
                    <div class="col-sm-4">
                        <select name="TanggalPanen" class="form-control">
                            @if(isset($_GET['TanggalPanen']))
                                <option value="{{$_GET['TanggalPanen']}}" selected>{{$_GET['TanggalPanen']}}</option>
                            @endif
                            @foreach($TanggalPanen->sortByDesc('JadwalPanen', SORT_NATURAL) as $data)
                                <option value="{{$data['JadwalPanen']}}">{{$data['JadwalPanen']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="Submit" name="Submit" class="col-sm-1 btn btn-primary m-2" value="1">Submit</button>
                    <a href="{{url('/admin/mylea/harvest-schedule')}}" class="col-sm-1 btn btn-danger m-2" value="1">Reset</a>
                </div>
            </form>
        </div>
      <table class="table" width="75%">
        <tr>
            <th>Kode Produksi</th>
            <th>Tanggal Panen</th>
            <th>Notes</th>
            <th>Under Incubation</th>
        </tr>
        @foreach($MyleaPanen->where('JadwalPanen', '>', $PanenDate)->sortByDesc('JadwalPanen', SORT_NATURAL) as $item)
            @if(isset($_GET['TanggalPanen']))
                @if($item['InStock'] != 0 && substr($item['JadwalPanen'], 0, 7) == $PanenDate)
                <tr>
                    <td>{{$item['KodeProduksi']}}</td>
                    <td>{{$item['JadwalPanen']}}</td>
                    <td>{{$item['Keterangan']}}</td>
                    <td>{{$item['InStock']}}</td>
                </tr>
                @endif
            @else
                @if($item['InStock'] != 0)
                <tr>
                    <td>{{$item['KodeProduksi']}}</td>
                    <td>{{$item['JadwalPanen']}}</td>
                    <td>{{$item['Keterangan']}}</td>
                    <td>{{$item['InStock']}}</td>
                </tr>
                @endif
            @endif
        @endforeach
      </table>
    </section>
@endsection