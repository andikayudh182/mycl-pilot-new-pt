@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sterilisasi</li>
            </ol>
        </nav>
    </div>
 
    <section class="m-5">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <table class="table">
            <tr>
                <th>Tanggal Pengerjaan</th>
                <th>Batch</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jenis Resep</th>
                <th>Jumlah Baglog</th>
                <th>In Stock</th>
            </tr>
            @foreach ($data as $data1)
                <tr>
                    <td>{{$data1['TanggalPengerjaan']}}</td>
                    <td>{{$data1['Batch']}}</td>
                    <td>{{$data1['JamMulai']}}</td>
                    <td>{{$data1['JamSelesai']}}</td>
                    <td>{{$data1['JenisResep'][0]}}</td>
                    <td>{{$data1['JumlahBaglog']}}</td>
                    <td>{{$data1['InStock']}}</td>
                    <td><a href="{{ route('FormSterilisasi', ['data'=>$data1['id'],])}}">Form Sterilisasi</a></td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection