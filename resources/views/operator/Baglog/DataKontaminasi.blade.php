@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/inkubasi-baglog') }}">Monitoring Inkubasi Baglog</a></li>
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
        <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Produksi</th>
                <th>Jumlah Kontaminasi</th>
                <th>Tanggal</th>
                <th>No Bibit</th>
                <th>Keterangan</th>
            </tr>
            
            @foreach ( $Konta as $data )
            <tr>
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['KodeProduksi'];?></td>
                <td><?php echo $data['JumlahKonta'];?></td>
                <td><?php echo $data['TanggalKonta'];?></td>
                <td><?php echo $data['NoBibit'];?></td>
                <td><?php echo $data['Keterangan'];?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                      Edit
                    </button>
                </td>
                @include('operator.Baglog.EditKontaminasiPartial')
            </tr>
            @endforeach


        </table>
    </section>

@endsection