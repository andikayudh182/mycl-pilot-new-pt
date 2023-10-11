@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/inkubasi-baglog') }}">Monitoring Inkubasi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontaminasi Baglog</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <form method="POST" action="{{ url('/operator/baglog/inkubasi-baglog/konta-submit')}}">
    @csrf
        <div class="row mb-3 ">
            <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
            <div class="col-sm-5">
                <input type="text" name="KodeProduksi" value="<?php echo $Konta['KodeProduksi'];?>" class="Disabled input example form-control-sm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="NoBibit" class="col-sm-2 col-form-label col-form-label-sm">Nomor Bibit :</label>
            <div class="col-sm-5">
                <input type="text" name="NoBibit" class="form-control form-control-sm  @error('NoBibit') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                @error('NoBibit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>       
        <div class="row mb-3 ">
            <label for="JumlahKonta" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Konta :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahKonta" class="form-control form-control-sm  @error('JumlahKonta') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                @error('JumlahKonta')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalKonta" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Kontaminasi :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalKonta" class="form-control form-control-sm  @error('TanggalKonta') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                @error('TanggalKonta')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
            <div class="col-sm-5">
                <input type="text" name="Keterangan" class="form-control form-control-sm  @error('Keterangan') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                @error('Keterangan')
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