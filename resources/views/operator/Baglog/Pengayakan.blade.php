@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengayakan</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <form method="POST" action="{{url('operator/baglog/pengayakan-submit', ['id'=>$id,])}}">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalPengerjaan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalPengerjaan" class="form-control form-control-sm @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value="">
                @error('TanggalPengerjaan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="NoKarung" class="col-sm-2 col-form-label col-form-label-sm">No Karung :</label>
            <div class="col-sm-5">
                <input type="text" name="NoKarung" class="form-control form-control-sm @error('NoKarung') is-invalid @enderror" id="colFormLabelSm" value="">
                @error('NoKarung')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BeratAwal" class="col-sm-2 col-form-label col-form-label-sm">Berat Awal :</label>
            <div class="col-sm-5">
                <input type="number" step="0.01" name="BeratAwal" class="form-control form-control-sm  @error('BeratAwal') is-invalid @enderror" id="colFormLabelSm" value="">
                @error('BeratAwal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BeratAkhir" class="col-sm-2 col-form-label col-form-label-sm">Berat Setelah Pengayakan:</label>
            <div class="col-sm-5">
                <input type="number" step="0.01" name="BeratAkhir" class="form-control form-control-sm  @error('BeratAkhir') is-invalid @enderror" id="colFormLabelSm" value="">
                @error('BeratAkhir')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> 
        <div class="row mb-3 ">
            <label for="NoKontainer" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer :</label>
            <div class="col-sm-5">
                <input type="text" name="NoKontainer" class="form-control form-control-sm  @error('NoKontainer') is-invalid @enderror" id="colFormLabelSm" value="">
                @error('NoKontainer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <input type="submit" value="submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection