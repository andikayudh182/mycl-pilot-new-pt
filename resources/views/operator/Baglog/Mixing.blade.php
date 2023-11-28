@extends('layouts.operator')

@section('content')
<div class="m-5">
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background-color: white">
          <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mixing</li>
      </ol>
  </nav>
</div>
<section class="m-5">
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
  @endif
    <h2>Mixing</h2>
    <div class="table-responsive-md" style="overflow-x: auto">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Approval</th>
            <th>Jenis Resep</th>
            <th>Berat Baglog</th>
            <th>Total Baglog</th>
            <th>No Karung Serbuk Kayu</th>
            <th>Serbuk Kayu</th>
            <th>Tapioka</th>
            <th>Pollard</th>
            <th>Kapur</th>
            <th>Air</th>    
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
                <td>{{$data['Type']}}</td>
                <td>{{$data['BeratBaglog']}}</td>
                <td>{{$data['TotalBags']}}</td>
                <td>{{$data['NoKarungSKayu']}}</td>
                <td>{{round($data['SKayu'],2)}}</td>
                <td>{{round($data['Tapioka'],2)}}</td>
                <td>{{round($data['Pollard'],2)}}</td>
                <td>{{round($data['Kapur'],2)}}</td>
                <td>{{round($data['Air'],2)}}</td>
                @if($data['Approval']=='0')
                @else
                <td><a href="{{url('/operator/baglog/mixing-form', ['resep_id'=>$data['id'],])}}">Form Pengerjaan</a></td>
                @endif
                <td>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                    Edit
                  </button>
                </td>
                @include('operator.Baglog.EditResepPartials')   
            </tr>
        @endforeach
    </table>
  </div>
</section>
@endsection