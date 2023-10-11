@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring Inkubasi Baglog</li>
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
    <h3>Data Kartu Kendali</h3>
    <table class="table m-3">
        <tr class="sticky-header">
            <th>Kode Produksi</th>
            <th>Tanggal Pembibitan</th>
            <th>Tanggal Crushing</th>
            <th>Status Crushing</th>
            <th>Tanggal Harvest</th>
            <th>Jumlah Baglog</th>
            <th>Kontaminasi</th>
            <th>Pemakaian Mylea</th>
            <th>In Stock</th>
            <th colspan="7" class="text-center">Status</th>
        </tr>
        @foreach ($Pembibitan as $data )
        <tr>
            <td><?php echo $data['KodeProduksi'];?></td>
            <td><?php echo $data['TanggalPengerjaan'];?></td>
            <td><?php echo $data['TanggalCrushing'];?></td>
            @if ($data['StatusCrushing']=='0')
                <td>Belum di crushing</td>
            @else
                <td>Sudah di crushing</td>
            @endif
            <td><?php echo $data['TanggalPanen'];?></td>
            <td><?php echo $data['JumlahBaglog'];?></td>
            <td><?php echo $data['Konta'];?></td>
            <td><?php echo $data['Pemakaian'];?></td>
            <td><?php echo $data['InStock']?></td>
            @if($data['StatusPanen']=='1')
                <td>Siap Produksi Mylea</td>
            @else
                <td>Inkubasi</td>
            @endif
            <td><a href="{{ url('operator/baglog/inkubasi-baglog/konta', ['id'=>$data['id'],])}}">Kontaminasi</a></td>
            <td><a href="{{ url('operator/baglog/inkubasi-baglog/konta-data', ['id'=>$data['KodeProduksi'],])}}"> Data Kontaminasi</a></td>
            <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#BaglogMyleaModal{{$data['id']}}" data-bs-dismiss="modal">
                    Data Mylea
                </a>
                @include('operator.Baglog.BaglogMyleaPartial') 
            </td>
            @if ($data['StatusCrushing']=='0')
            <td><a href="{{ url('operator/baglog/inkubasi-baglog/crushing', ['id'=>$data['id'],])}}">Crushing</a></td>
            @else
            <td><a role="link" aria-disabled="true">Crushing</a></td>
            @endif

            <td><a href="{{ url('operator/baglog/inkubasi-baglog/panen', ['id'=>$data['id'],])}}">Siap Produksi Mylea</a></td>
            <td><a href="{{ url('operator/baglog/inkubasi-baglog/archive', ['id'=>$data['id'],])}}">Selesai</a></td>
        </tr>  
        @endforeach
        <div class="d-flex justify-content-center">
            {!! $Pembibitan->links() !!}
          </div>
    </table>
</section>
@endsection