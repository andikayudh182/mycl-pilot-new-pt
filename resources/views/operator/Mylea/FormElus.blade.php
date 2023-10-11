@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Monitoring</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Elus</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <h3>Form Elus</h3>
    <form action="{{ url('/operator/mylea/form-elus-submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalElus" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Elus :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalElus" class="form-control form-control-sm  @error('TanggalElus') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
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
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Kode Produksi Mylea</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][KodeMylea]" class="form-select" id="KodeMylea">
                        @foreach ($Data as $item)
                            @if($item['InStock'] != 0)
                                <option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>
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

        <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][KodeMylea]" class="form-select" id="KodeMylea">@foreach ($Data as $item)<option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>@endforeach</select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>
@endsection