@extends('layouts.admin')

@section('content')
<div class="m-5">
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background-color: white">
          <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
          <li class="breadcrumb-item active" aria-current="page">Resep Mixing</li>
      </ol>
  </nav>
</div>
<section class="m-5">
    <h2>Resep Mixing</h2>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Approval</th>
            <th>Berat Baglog</th>
            <th>Jumlah</th>
            <th colspan="2">Serbuk Kayu</th>
            <th colspan="2">Tapioka</th>
            <th colspan="2">Pollard</th>
            <th colspan="2">Kapur</th>
            <th colspan="2">Air</th>     
        </tr>
        @foreach ($resep as $data)
            <tr>
                <td> {{$data['id']}} </td>
                <td>{{$data['created_at']}}</td>
                @if($data['Approval']=='0')
                <td> Belum disetujui </td>
                @else
                <td> Sudah disetujui </td>
                @endif
                <td>{{$data['BeratBaglog']}}</td>
                <td>{{round($data['TotalBags'],2)}}</td>
                <td>{{$data['SKayu']}} kg </td>
                <td>{{$data['MCSKayu']}} %</td>
                <td>{{$data['Tapioka']}} kg </td>
                <td>{{$data['MCTapioka']}} % </td>
                <td>{{$data['Pollard']}} kg </td>
                <td>{{$data['MCPollard']}} % </td>
                <td>{{$data['Kapur']}} kg </td>
                <td>{{$data['MCKapur']}} % </td>
                <td colspan="2">{{$data['Air']}} kg </td>
                <td> <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample<?php echo $data['id']?>" role="button" aria-controls="offcanvasExample">Detail</a></td>
                <td> <a href="{{url('admin/baglog/data-recipe/approve', ['id'=>$data['id'],])}}">Setujui</a></td>
            </tr>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample<?php echo $data['id']?>" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{$data['id']}}</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <div>
                    MC Serbuk Kayu : {{$data['MCSKayu']}} % <br>
                    MC Tapioka : {{$data['MCTapioka']}} % <br>
                    MC Pollard : {{$data['MCPollard']}} % <br>
                    MC Kapur : {{$data['MCKapur']}} % <br>
                    <br>
                    Serbuk Kayu : {{$data['SKayu']}} kg <br>
                    No Karung : {{$data['NoKarungSKayu']}}<br>
                    Tapioka : {{$data['Tapioka']}} kg <br>
                    Pollard : {{$data['Pollard']}} kg <br>
                    Kapur : {{$data['Kapur']}} kg <br>
                    Air : {{$data['Air']}} kg <br>
                  </div>
                </div>
              </div>
        @endforeach
    </table>
</section>
@endsection