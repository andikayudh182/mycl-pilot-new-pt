<h3>Form Reinforce</h3>
<form id="FormInputData" action="{{ route('ReinforceSubmit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="PT_ID" name="id">
    <div class="row mb-3 ">
        <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan  :</label>
        <div class="col-sm-5">
            <input type="date" id="TanggalPengerjaan" name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
            @error('TanggalPengerjaan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div> 
    {{-- {{ $FormData }}  --}}
    <table class="table table-bordered" id="dynamicAddRemove">
        <tr>
            <th>Batch - Warna - Size - Available</th>
            <th>Jenis</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td>
                <select name="data[0][CuringID]" class="form-control select2-single" id="CuringID" style="width:100%; background-color: #f8fafc;">
                    @foreach ($FormData as $item)
                        @if ($item['Jumlah'] > 0)
                            <option value="{{$item['id'].",".$item['Size']}}">{{$item['Batch']}} - {{ $item['Warna'] }} - {{ $item['Size'] }} (Available : {{ $item['Jumlah'] }})</option>                
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <select name="data[0][Jenis]" id="Jenis" class="form-control" style="width:100%; background-color: #f8fafc">
                    <option value="Euca Sateen">Euca Sateen</option>
                    <option value="Lyco Linen">Lyco Linen</option>
                    <option value="Other">Other</option>
                </select>
            </td>
            <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah</button></td>
        </tr>
    </table>

    <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto"> 
</form>

<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script>
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
        $("#dynamicAddRemove").append('<tr>'+
            '<td>' +
                '<select name="data['+i+'][CuringID]" class="form-control select2-single" id="CuringID'+i+'" style="width:100%; background-color: #f8fafc;">' +
                    '@foreach ($FormData as $item)' +
                        '@if ($item['Jumlah'] > 0)' +
                            '<option value="{{$item['id'].",".$item['Size']}}">{{$item['Batch']}} - {{ $item['Warna'] }} - {{ $item['Size'] }} (Available : {{ $item['Jumlah'] }})</option>' +
                        '@endif'+
                    '@endforeach'+
                '</select>' +
            '</td>'+
            '<td>' +
                '<select name="data['+i+'][Jenis]" id="Jenis" class="form-control" style="width:100%; background-color: #f8fafc">'+
                    '<option value="Euca Sateen">Euca Sateen</option>'+  
                    '<option value="Lyco Linen">Lyco Linen</option>'+
                    '<option value="Other">Other</option>'+ 
                '</select>'+
            '</td>'+
            '<td><input type="number" name="data['+i+'][Jumlah]" class="form-control" /></td>' +
        '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        setTimeout(function(){
        $("#CuringID" + i).select2({
            theme: "bootstrap4"
        });
        }, 100);
        });

        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
        $("#CuringID").select2({
            theme: "bootstrap4"
        });
    </script>
    <style>
    </style>
</div>