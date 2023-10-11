@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/sterilisasi-option')}}">Sterilisasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Sterilisasi</li>
            </ol>
        </nav>
    </div>
    <section class="m-5">
        <form method="POST" action="{{url('/operator/baglog/sterilisasi-submit',)}}" class="m-5">
            @csrf
            <div class="row mb-3 ">
                <label for="TanggalPengerjaan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
                <div class="col-sm-5">
                    <input type="date"  name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                    @error('TanggalPengerjaan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Batch" class="col-sm-2 col-form-label col-form-label-sm">Batch :</label>
                <div class="col-sm-5">
                    <input type="number"  name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Batch') }}">
                    @error('Batch')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="NoAutoclave" class="col-sm-2 col-form-label col-form-label-sm">No Autoclave :</label>
                <div class="col-sm-5">
                    <input type="number"  name="NoAutoclave" class="form-control form-control-sm  @error('NoAutoclave') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoAutoclave') }}">
                    @error('NoAutoclave')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
                <div class="col-sm-5">
                    <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamMulai') }}">
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
                    <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamSelesai') }}">
                    @error('JamSelesai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglog') }}">
                    @error('JumlahBaglog')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Kondisi" class="col-sm-2 col-form-label col-form-label-sm">Kondisi :</label>
                <div class="col-sm-5">
                    <select name="Kondisi" class="form-control form-control-sm" id="colFormLabelSm" >
                                <option value="Sesuai">Sesuai</option>
                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBaglogBerlubang" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog Berlubang :</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBaglogBerlubang" class="form-control form-control-sm  @error('JumlahBaglogBerlubang') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglogBerlubang') }}">
                    @error('JumlahBaglogBerlubang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahTapeTidakHitam" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Autoclave Tape Tidak Hitam:</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahTapeTidakHitam" class="form-control form-control-sm  @error('JumlahTapeTidakHitam') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahTapeTidakHitam') }}">
                </div>
            </div>
            <input type="hidden" name="mixing_id" value="{{$data}}">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </section>
@endsection