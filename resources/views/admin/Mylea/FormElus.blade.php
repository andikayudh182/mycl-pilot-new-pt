@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Elus</li>
        </ol>
    </nav>
  </div>

<section class="m-5">
    <h3>Form Elus {{$KodeProduksi}}</h3>
    <form method="POST" action="{{url('/admin/mylea/report/elus-submit')}}" class="m-5">
        @csrf
        <input type="hidden"  name="KPMylea" value="{{$KodeProduksi}}">
        <div class="row mb-3 ">
            <label for="TanggalElus" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalElus" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm">
                @error('TanggalElus')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
            <div class="col-sm-5">
                <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm">
                @error('JamMulai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JamSelesai" class="col-sm-2 col-form-label col-form-label-sm">Jam Selesai :</label>
            <div class="col-sm-5">
                <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm">
                @error('JamSelesai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah  :</label>
            <div class="col-sm-5">
                <input type="number"  name="Jumlah" class="form-control form-control-sm  @error('Jumlah') is-invalid @enderror" id="colFormLabelSm">
                @error('Jumlah')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection