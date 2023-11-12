@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Produksi Mylea</li>
        </ol>
    </nav>
</div>
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
    <h2>Produksi Mylea</h2>
    <form action="{{ url('/operator/mylea/form-produksi-submit') }}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalProduksi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Produksi :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalProduksi" class="form-control form-control-sm  @error('TanggalProduksi') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalProduksi') }}">
                @error('TanggalProduksi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalElus1" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Elus 1 :</label>
            <div class="col-sm-5">
                <input type="date"  name="TanggalElus1" class="form-control form-control-sm  @error('TanggalElus1') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalElus1') }}">
                @error('TanggalElus1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
            <div class="col-sm-5">
                <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('JamMulai') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamMulai') }}">
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
                <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('JamSelesai') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamSelesai') }}">
                @error('JamSelesai')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
            <div class="col-sm-5">
                <input type="text"  name="Keterangan" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Keterangan') }}">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahTray" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Tray :</label>
            <div class="col-sm-5">
                <input type="number"  name="JumlahTray" class="form-control form-control-sm  @error('JumlahTray') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahTray') }}">
                @error('JumlahTray')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Kode Produksi Baglog</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][KodeBaglog]" class="form-select" id="KodeBaglog">
                        @foreach ($Data as $item)
                            <option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>
                        @endforeach
                        @foreach ($BaglogRnD as $data)
                        <option value="{{$data['KodeProduksi']}}">{{$data['KodeProduksi']}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td>
                    <select name="data[0][KondisiBaglog]" class="form-control form-control-sm" id="colFormLabelSm" >
                        <option value="Non Crushing">Non Crushing</option>
                        <option value="Crushing-Putih Semua">Crushing-Putih Semua</option>
                        <option value="Crushing-Setengah Tumbuh">Crushing-Setengah Tumbuh</option>
                    </select>
                </td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Baglog</button></td>
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
        $("#dynamicAddRemove").append('<tr><td><select name="data['+ i +'][KodeBaglog]" class="form-select" id="KodeBaglog">@foreach ($Data as $item)<option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>@endforeach @foreach ($BaglogRnD as $data)<option value="{{$data['KodeProduksi']}}">{{$data['KodeProduksi']}}</option>@endforeach</select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><select name="data['+ i +'][KondisiBaglog]" class="form-control form-control-sm" id="colFormLabelSm" ><option value="Non Crushing">Non Crushing</option><option value="Crushing-Putih Semua">Crushing-Putih Semua</option><option value="Crushing-Setengah Tumbuh">Crushing-Setengah Tumbuh</option></select></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
        function SetMax(i) {
            name = "BaglogCode" + i;
            var e = document.getElementById("BaglogCode" + i);
            var value = e.options[e.selectedIndex].value;

            let obj = dat.find(o => o.id === parseInt(value));
            var max = obj.InStock;
            inputId = "#Quantity" + i;

            $(inputId).attr({
                "max" : max,
                "min" : 1
            });
        }
    </script>
</section>

@endsection
