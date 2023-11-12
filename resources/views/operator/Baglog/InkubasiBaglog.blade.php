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
            <th>Jumlah Baglog</th>
            <th>Batch</th>
            <th>Jenis</th>
            <th>Jumlah Bibit</th>
            <th colspan="2">Aksi</th>
        </tr>
        @foreach ($Pembibitan as $data )
        <tr>
            <td><?php echo $data['KodeProduksi'];?></td>
            <td><?php echo $data['TanggalPengerjaan'];?></td>
            <td><?php echo $data['JumlahBaglog'];?></td>
            <td>{{$data['BatchBibitTerpakai']}}</td>
            <td>{{substr($data['KodeProduksi'], 11)}}</td>
            <td>{{$data['BibitTerpakai']}}</td>
            <td>
                <a href="{{ route('FormEditBaglog', $data->id) }}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('DeleteBaglog', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" title="Delete">Delete</button>
                </form>
            </td>
        </tr>  
        @endforeach
        <div class="d-flex justify-content-center">
            {!! $Pembibitan->links() !!}
          </div>
    </table>
</section>
@endsection