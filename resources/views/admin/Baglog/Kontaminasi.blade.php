@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontaminasi</li>
        </ol> 
    </nav>
    </div>

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
                <th>Ditemukan Oleh</th>
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
                    @foreach ($user as $userdata)
                        @if($data['user_id']==$userdata['id'])
                            <?php echo $userdata['name']?>
                        @endif
                    @endforeach

                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                      Edit
                    </button>
                </td>
                @include('admin.Baglog.EditKontaminasiPartial')
                <td><a href="{{ route('DeleteKontaBaglog', ['id'=>$data['id'],])}}">Delete</a></td>
            </tr>
            @endforeach


        </table>
    </section>

@endsection