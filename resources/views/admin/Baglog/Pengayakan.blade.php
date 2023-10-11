@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pengayakan</li>
        </ol> 
    </nav> 
    </div>

    <section class="m-5">
        <table class="table">
            <tr>
                <th>Tanggal Pengerjaan</th>
                <th>No Karung</th>
                <th>Berat Awal</th>
                <th>Berat Akhir</th>
                <th>No Kontainer</th>
                <th>Dikerjakan Oleh</th>
            </tr>
            @foreach ($data as $data1)
                <tr>
                    <td>{{$data1['TanggalPengerjaan']}}</td>
                    <td>{{$data1['NoKarung']}}</td>
                    <td>{{$data1['BeratAwal']}}</td>
                    <td>{{$data1['BeratAkhir']}}</td>
                    <td>{{$data1['NoKontainer']}}</td>
                    <td>
                        @foreach ($user as $userdata)
                            @if($data1['user_id']==$userdata['id'])
                                <?php echo $userdata['name']?>
                            @endif
                        @endforeach
                    </td>
                    <td><a href="{{ route('DeletePengayakan', ['id'=>$data1['id'],])}}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </section>

    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
      </div>
@endsection