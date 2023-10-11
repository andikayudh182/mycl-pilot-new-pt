@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/sterilisasi-option')}}">Monitoring Inkubasi Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Sterilisasi</li>
            </ol>
        </nav>
    </div>
    <section class="m-5">
        <form method="POST" action="{{url('/operator/baglog/inkubasi-baglog/crushing-submit')}}" class="m-5">
            @csrf
            <div class="row mb-3 ">
                <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                <div class="col-sm-5">
                    <input type="text"  name="KodeProduksi" class="form-control form-control-sm  @error('KodeProduksi') is-invalid @enderror" id="colFormLabelSm" value="{{ $KodeProduksi }}">
                    @error('KodeProduksi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TanggalCrushing" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Crushing :</label>
                <div class="col-sm-5">
                    <input type="date"  name="TanggalCrushing" class="form-control form-control-sm  @error('TanggalCrushing') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                    @error('TanggalCrushing')
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
                <label for="KondisiBaglog" class="col-sm-2 col-form-label col-form-label-sm">KondisiBaglog :</label>
                <div class="col-sm-5">
                    <select name="KondisiBaglog" class="form-control form-control-sm" id="colFormLabelSm" >
                                <option value="Semua tumbuh sampai putih">Semua tumbuh sampai putih</option>
                                <option value="Semua tidak tumbuh sama sekali">Semua tidak tumbuh sama sekali</option>
                                <option value="Semua tumbuh tapi tidak merata">Semua tumbuh tapi tidak merata</option>
                                <option value="Sebagian tumbuh, sebagian tidak">Sebagian tumbuh, sebagian tidak</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBaglogPutih" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Putih :</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBaglogPutih" class="form-control form-control-sm  @error('JumlahBaglogPutih') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglogPutih') }}">
                    @error('JumlahBaglogPutih')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBaglogTidakTumbuh" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Tidak Tumbuh :</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBaglogTidakTumbuh" class="form-control form-control-sm  @error('JumlahBaglogTidakTumbuh') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglogTidakTumbuh') }}">
                    @error('JumlahBaglogTidakTumbuh')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JumlahBaglogTidakMerata" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Tumbuh Tidak Merata:</label>
                <div class="col-sm-5">
                    <input type="number"  name="JumlahBaglogTidakMerata" class="form-control form-control-sm  @error('JumlahBaglogTidakMerata') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglogTidakMerata') }}">
                    @error('JumlahBaglogTidakMerata')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TotalBaglog" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Total :</label>
                <div class="col-sm-5">
                    <input type="number"  name="TotalBaglog" class="form-control form-control-sm  @error('TotalBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TotalBaglog') }}">
                    @error('TotalBaglog')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="pembibitan_id" value="{{$id}}">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </section>
@endsection