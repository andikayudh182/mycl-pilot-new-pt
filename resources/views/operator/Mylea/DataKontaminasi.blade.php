@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/monitoring') }}">Monitoring Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Kontaminasi</li>
        </ol>
    </nav>
</section>

    <section class="m-5 container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <h3>{{$KodeProduksi}}</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Produksi Baglog</th>
                <th>Tanggal Kontaminasi</th>
                <th>Jumlah Kontaminasi</th>
                <th>No Bibit</th>
                <th>Kondisi Baglog</th>
                <th>Keterangan</th>
            </tr>
            
            @foreach ( $Kontaminasi as $data )
            <tr>
                <td><?php echo $data['id'];?></td>
                <td>{{$data['KPBaglog']}}</td>
                <td><?php echo $data['TanggalKontaminasi'];?></td>
                <td><?php echo $data['Jumlah'];?></td>
                <td><?php echo $data['NoBibit'];?></td>
                <td>{{$data['KondisiBaglog']}}</td>
                <td><?php echo $data['Keterangan'];?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                      Edit
                    </button>
                </td>
                @include('operator.Mylea.EditKontaminasiPartial')
            </tr>
            @endforeach


        </table>
    </section>

@endsection