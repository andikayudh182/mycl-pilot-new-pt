@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Sterilisasi</li>
        </ol> 
    </nav> 
    </div>

    <section class="m-5">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <table class="table">
            <tr>
                <th>@sortablelink('TanggalPengerjaan', 'Tanggal Pengerjaan')</th>
                <th>@sortablelink('Batch')</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jumlah Baglog</th>
                <th>Kondisi</th>
                <th>Jumlah Baglog Berlubang</th>
                <th>Jumlah Autoclave Tidak Hitam</th>
                <th>Dikerjakan Oleh</th>
            </tr>
            @foreach ($data as $data1)
                <tr>
                    <td>{{$data1['TanggalPengerjaan']}}</td>
                    <td>{{$data1['Batch']}}</td>
                    <td>{{$data1['JamMulai']}}</td>
                    <td>{{$data1['JamSelesai']}}</td>
                    <td>{{$data1['JumlahBaglog']}}</td>
                    <td>{{$data1['Kondisi']}}</td>
                    <td>{{$data1['JumlahBaglogBerlubang']}}</td>
                    <td>{{$data1['JumlahTapeTidakHitam']}}</td>
                    <td>
                        @foreach ($user as $userdata)
                            @if($data1['user_id']==$userdata['id'])
                                <?php echo $userdata['name']?>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data1['id']}}">
                          Edit
                        </button>
                    </td>
                    @include('admin.Baglog.EditSterilisasiPartial')
                    <td><a href="{{ route('DeleteSterilisasi', ['id'=>$data1['id'],])}}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </section>

    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
      </div>
@endsection