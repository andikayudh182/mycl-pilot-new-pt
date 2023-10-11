@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/baglog/report') }}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Details</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @foreach($data as $Data)
    <form method="POST" action="{{ url('/admin/baglog/report-details-submit')}}">
        @csrf
        <input type="hidden"  name="id" value="{{ $Data['id'] }}">
        <input type="hidden"  name="KodeProduksi" value="{{ $Data['KodeProduksi'] }}">
        <div class="row mb-3 ">
            <label for="TanggalPengerjaan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['TanggalPengerjaanDT'] }}">
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
                <input type="number"  name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['Batch'] }}">
                @error('Batch')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalSterilisasi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sterilisasi :</label>
            <div class="col-sm-5">
                <input type="text"  name="TanggalSterilisasi" class="form-control form-control-sm  @error('TanggalSterilisasi') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['TanggalSterilisasi'] }}" disabled>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
            <div class="col-sm-5">
                <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['JumlahBaglog'] }}">
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
                            <option value="{{$Data['Kondisi']}}" selected>{{$Data['Kondisi']}}</option>
                            <option value="Sesuai">Sesuai</option>
                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BibitTerpakai" class="col-sm-2 col-form-label col-form-label-sm">Bibit Terpakai :</label>
            <div class="col-sm-5">
                <input type="number"  name="BibitTerpakai" class="form-control form-control-sm  @error('BibitTerpakai') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['BibitTerpakai'] }}">
                @error('BibitTerpakai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BatchBibitTerpakai" class="col-sm-2 col-form-label col-form-label-sm">Batch Bibit Terpakai:</label>
            <div class="col-sm-5">
                <input type="date"  name="BatchBibitTerpakai" class="form-control form-control-sm  @error('BatchBibitTerpakai') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['BatchBibitTerpakaiDT'] }}">
                @error('BatchBibitTerpakai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BibitReject" class="col-sm-2 col-form-label col-form-label-sm">Bibit Reject (sobek/tua) :</label>
            <div class="col-sm-5">
                <input type="number"  name="BibitReject" class="form-control form-control-sm  @error('BibitReject') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['BibitReject'] }}">
                @error('BibitReject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="BatchBibitDibuang" class="col-sm-2 col-form-label col-form-label-sm">Batch Bibit Dibuang:</label>
            <div class="col-sm-5">
                <input type="date"  name="BatchBibitDibuang" class="form-control form-control-sm  @error('BatchBibitDibuang') is-invalid @enderror" id="colFormLabelSm" value="{{ $Data['BatchBibitDibuangDT'] }}">
                @error('BatchBibitDibuang')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        説明文 説明文  説明文
        <div class="row mb-3 ">
            <label for="StatusArchive" class="col-sm-2 col-form-label col-form-label-sm">Status Archive :</label>
            <div class="col-sm-5">
                <select name="StatusArchive" class="form-control form-control-sm" id="colFormLabelSm" >
                            <option value="{{$Data['StatusArchive']}}" selected>{{$Data['StatusArchiveLabel']}}</option>
                            <option value="1">Archived</option>
                            <option value="0">Active</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
    @endforeach
</section>
@endsection