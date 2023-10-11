@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Mixing</li>
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
                <th>@sortablelink('TanggalPengerjaan', 'Tanggal Pengerjaan', ['filter' => 'active, visible'])</th>
                <th>@sortablelink('Batch')</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jumlah Baglog</th>
                <th>MC Baglog Awal</th>
                <th>MC Baglog Akhir</th>
                <th>Dikerjakan Oleh</th>
                <th>Resep</th>
            </tr>
            @foreach ($data as $data1)
                <tr>
                    <td>{{$data1['TanggalPengerjaan']}}</td>
                    <td>{{$data1['Batch']}}</td>
                    <td>{{$data1['JamMulai']}}</td>
                    <td>{{$data1['JamSelesai']}}</td>
                    <td>{{$data1['JumlahBaglog']}}</td>
                    <td>{{$data1['MCBaglog']}}</td>
                    <td>{{$data1['MCBaglogAkhir']}}</td>
                    <td>
                        @foreach ($user as $userdata)
                            @if($data1['user_id']==$userdata['id'])
                                <?php echo $userdata['name']?>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($resep as $resepdata)
                            @if($data1['resep_id']==$resepdata['id'])
                                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample<?php echo $resepdata['id']?>" role="button" aria-controls="offcanvasExample">Detail Resep</a>
                                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample<?php echo $resepdata['id']?>" aria-labelledby="offcanvasExampleLabel">
                                    <div class="offcanvas-header">
                                      <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{$resepdata['id']}}</h5>
                                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                      <div>
                                        Berat Baglog : {{$resepdata['BeratBaglog']}}gram<br>
                                        Total Baglog : {{$resepdata['TotalBags']}} buah<br>
                                        <br>
                                        MC Serbuk Kayu : {{$resepdata['MCSKayu']}} % <br>
                                        MC Tapioka : {{$resepdata['MCTapioka']}} % <br>
                                        MC Pollard : {{$resepdata['MCPollard']}} % <br>
                                        MC Kapur : {{$resepdata['MCKapur']}} % <br>
                                        <br>
                                        Serbuk Kayu : {{$resepdata['SKayu']}} kg <br>
                                        No Karung : {{$resepdata['NoKarungSKayu']}}<br>
                                        Tapioka : {{$resepdata['Tapioka']}} kg <br>
                                        Pollard : {{$resepdata['Pollard']}} kg <br>
                                        Kapur : {{$resepdata['Kapur']}} kg <br>
                                        Air : {{$resepdata['Air']}} kg <br>
                                      </div>
                                    </div>
                                  </div>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data1['id']}}">
                          Edit
                        </button>
                    </td>
                    @include('admin.Baglog.EditMixingPartials')
                    <td><a href="{{ route('DeleteMixing', ['id'=>$data1['id'],])}}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </section>

    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
      </div>
@endsection