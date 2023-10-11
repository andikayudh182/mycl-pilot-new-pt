@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
        </ol>
    </nav>
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

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <h3>Production Report</h3>
        <table class="table">
            <tr class="sticky-header">
                <th>Kode Produksi</th>
                <th>Tanggal Produksi</th>
                <th>Jumlah</th>
                <th>Kontaminasi</th>
                <th>Panen</th>
                <th>In Stock</th>
                <th colspan="3" class="text-center">Aksi</th>
            </tr>
            @foreach ($Data as $data)
                @if($data['InStock'] != 0)
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['Jumlah']}}</td>
                    <td>{{$data['Konta']}}</td>
                    <td>{{$data['Panen']}}</td>
                    <td>{{$data['InStock']}}</td>
                    <td><a href="{{url('/operator/mylea/monitoring/form-kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Kontaminasi</a></td>
                    <td><a href="{{url('/operator/mylea/monitoring/data-kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Data Kontaminasi</a></td>
                    <td><a href="{{url('/operator/mylea/monitoring/form-panen', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Panen</a></td>
                </tr>
                @endif
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
          </div>
</section>
@endsection