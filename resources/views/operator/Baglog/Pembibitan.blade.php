@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembibitan</li>
            </ol>
        </nav>
    </div>
    <section class="m-5">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <form method="POST" action="{{url('/operator/baglog/pembibitan-submit',)}}" class="m-5">
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
                <label for="BibitTerpakai" class="col-sm-2 col-form-label col-form-label-sm">Bibit Terpakai :</label>
                <div class="col-sm-5">
                    <input type="number"  name="BibitTerpakai" class="form-control form-control-sm  @error('BibitTerpakai') is-invalid @enderror" id="colFormLabelSm" value="{{ old('BibitTerpakai') }}">
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
                    <input type="date"  name="BatchBibitTerpakai" class="form-control form-control-sm  @error('BatchBibitTerpakai') is-invalid @enderror" id="colFormLabelSm" value="{{ old('BatchBibitTerpakai') }}">
                    @error('BatchBibitTerpakai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- <div class="row mb-3 ">
                <label for="BibitReject" class="col-sm-2 col-form-label col-form-label-sm">Bibit Reject (sobek/tua) :</label>
                <div class="col-sm-5">
                    <input type="number"  name="BibitReject" class="form-control form-control-sm  @error('BibitReject') is-invalid @enderror" id="colFormLabelSm" value="{{ old('BibitReject') }}">
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
                    <input type="date"  name="BatchBibitDibuang" class="form-control form-control-sm  @error('BatchBibitDibuang') is-invalid @enderror" id="colFormLabelSm" value="{{ old('BatchBibitDibuang') }}">
                    @error('BatchBibitDibuang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div> --}}
            <div class="row mb-3 ">
                <label for="KodeBibit" class="col-sm-2 col-form-label col-form-label-sm">Kode Bibit:</label>
                <div class="col-sm-5">
                    <input type="text"  name="KodeBibit" class="form-control form-control-sm  @error('KodeBibit') is-invalid @enderror" id="colFormLabelSm" value="{{ old('KodeBibit') }}">
                    @error('KodeBibit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Batch Sterilisasi</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>
                        <select name="data[0][sterilisasi_id]" class="form-select" id="sterilisasi_id">
                            @foreach ($DataSterilisasi as $data)
                                @if($data['InStock']!= 0)
                                    <option value="{{$data['id']}}">{{$data['TanggalPengerjaan'].' : '.$data['Batch']." (".$data['Type'].") "." [".$data['InStock']."]"}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah</button></td>
                </tr>
            </table>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][sterilisasi_id]" class="form-select" id="sterilisasi_id">@foreach ($DataSterilisasi as $data) @if($data['InStock']!=0)<option value="{{$data['id']}}">{{$data['TanggalPengerjaan'].' : '.$data['Batch']." (".$data['Type'].") "." [".$data['InStock']."]"}}</option>@endif @endforeach</select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endsection