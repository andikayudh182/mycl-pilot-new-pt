@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/mixing')}}">Mixing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Mixing</li>
            </ol>
        </nav>
    </div>
    <section class="m-5">
        <form method="POST" action="{{url('/operator/baglog/mixing-form-submit', ['id' => $resep_id,])}}" class="m-5">
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
                <label for="MCBaglog" class="col-sm-2 col-form-label col-form-label-sm">MC Baglog Awal:</label>
                <div class="col-sm-5">
                    <input type="number" step="any"  name="MCBaglog" class="form-control form-control-sm  @error('MCBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCBaglog') }}">
                    @error('MCBaglog')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="MCBaglogAkhir" class="col-sm-2 col-form-label col-form-label-sm">MC Baglog Akhir:</label>
                <div class="col-sm-5">
                    <input type="number" step="any"  name="MCBaglogAkhir" class="form-control form-control-sm  @error('MCBaglogAkhir') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCBaglogAkhir') }}">
                    @error('MCBaglogAkhir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="BeratAktual" class="col-sm-2 col-form-label col-form-label-sm">Berat Aktual :</label>
                <div class="col-sm-5">
                    <input type="number" step="any" name="BeratAktual" class="form-control form-control-sm  @error('BeratAktual') is-invalid @enderror" id="colFormLabelSm" value="{{ old('BeratAktual') }}">
                    @error('BeratAktual')
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