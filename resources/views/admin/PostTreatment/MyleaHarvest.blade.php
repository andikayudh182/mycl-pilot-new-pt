@extends('layouts.admin')

@section('content')
{{-- <section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/post-treatment-index') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mylea Panen</li>
        </ol>
    </nav>
</section> --}}
<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if(session()->has('message2'))
    <div class="alert alert-danger">
        {{ session()->get('message2') }}
    </div>
    @endif
    <h3>Mylea Panen Summary </h3>
    <h5> Total Panen : {{ $Total }}</h5>
    <h5> Total Reject Panen : {{ $TotalRejectPanen  }}</h5>  

    
    <form action="{{url('/admin/post-treatment/mylea-harvest')}}" method="GET">
        <p>
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Filter by Tanggal Panen
          </a>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="row mb-3 ">
              <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAwal') }}">
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAkhir') }}">
              </div>
          </div>
          <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
          </div>
        </div>
      
        <div class="input-group mb-3" style="width:250px">
          <input type="text" name="SearchQuery" placeholder="Search Kode Mylea" value="{{ old('SearchQuery') }}" class="form-control">
          <div class="input-group-append">
            <input name="Submit" type="submit" value="Search" class="btn btn-outline-primary">
          </div>
        </div>
    </form>
    <table class="table">
        <tr class="sticky-header">
            <th>Kode Mylea</th>
            <th>Tanggal Panen</th>
            <th>Jumlah Panen</th>
            <th>Reject Panen</th>
        </tr>
        @foreach($Trial as $data)
            <tr id = {{"Panen".$data['id']}}>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                        {{$data['KPMylea']}}
                    </button>
                    @include('admin.PostTreatment.Partials.MyleaPanenDetails')
                </td>
                <td>{{$data['TanggalPanen']}}</td>
                <td>{{$data['Jumlah']}}</td>
                <td>{{ $data['Kerik']->sum('RejectBeforeKerik') }} </td>
                     @if($data['Jumlah']-$data['PostTreatment']->sum('Jumlah') < 0)
                <script>
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.color="red";
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.background="rgba(221,221,221,0.8)";
                </script>
                    @elseif($data['kerik']->sum('Jumlah')-$data['PostTreatment']->sum('Jumlah') < 0)
                <script>
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.color="red";
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.background="rgba(221,221,221,0.8)";
                </script>
                @endif
            </tr>
        
        @endforeach
        
    </table>

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

@endsection