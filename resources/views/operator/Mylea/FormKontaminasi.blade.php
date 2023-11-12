@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Monitoring</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Kontaminasi</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('Error'))
        <div class="alert alert-danger">
            {{ session()->get('Error') }}
        </div>
    @endif
    <h3>Form Kontaminasi</h3>
    <form action="{{ url('/operator/mylea/form-kontaminasi-submit') }}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalKontaminasi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Kontaminasi :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalKontaminasi" class="form-control form-control-sm  @error('TanggalKontaminasi') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                @error('TanggalKontaminasi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <input type="hidden" name="KPMylea" value="{{$KodeProduksi}}">
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Kode Produksi Baglog</th>
                <th>Jumlah</th>
                <th>No Bibit</th>
                <th>Kondisi Baglog</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][KodeBaglog]" class="form-select" id="KodeBaglog">
                        @foreach ($Baglog as $item)
                            <option value="{{$item['KPBaglog']}}">{{$item['KPBaglog']}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td><input type="text" name="data[0][NoBibit]" class="form-control" /></td>
                <td>
                    <select name="data[0][KondisiBaglog]" class="form-control form-control-sm" id="colFormLabelSm" >
                        <option value="Non Crushing">Non Crushing</option>
                        <option value="Crushing">Crushing</option>
                    </select>
                </td>
                <td><input type="text" name="data[0][Keterangan]" class="form-control" /></td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Baglog</button></td>
            </tr>
        </table> 
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto"> 
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][KodeBaglog]" class="form-select" id="KodeBaglog">@foreach ($Baglog as $item)<option value="{{$item['KPBaglog']}}">{{$item['KPBaglog']}}</option>@endforeach</select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><input type="text" name="data['+ i +'][NoBibit]" class="form-control" /></td><td><select name="data['+ i +'][KondisiBaglog]" class="form-control form-control-sm" id="colFormLabelSm" ><option value="Non Crushing">Non Crushing</option><option value="Crushing">Crushing</option></select></td><td><input type="text" name="data['+ i +'][Keterangan]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>
@endsection