    <h3>Form Wet Process</h3>
    <form id="FormInputData" action="{{ url('/operator/post-treatment/form-post-treatment-submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="PT_ID" name="id">
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal  :</label>
            <div class="col-sm-5">
                <input type="date" id="Tanggal" name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}" required>
                @error('Tanggal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Batch" class="col-sm-2 col-form-label col-form-label-sm">Batch  :</label>
            <div class="col-sm-5">
                <input type="text" id="Batch" name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Batch') }}" required>
                @error('Batch')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div id="total-container"  class="row mb-3 ">
            <label for="TotalPenggunaanMylea" class="col-sm-2 col-form-label col-form-label-sm">Total Penggunaan Mylea  :</label>
            <div class="col-sm-5">
                <input type="text" id="TotalPenggunaanMylea" name="TotalPenggunaanMylea" class="form-control form-control-sm  @error('TotalPenggunaanMylea') is-invalid @enderror" value="0" id="colFormLabelSm" readonly>
                @error('TotalPenggunaanMylea')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        {{-- {{ $FormData }}  --}}
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Kode Produksi Mylea</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][KodeMylea]" class="form-control select2-single" id="KodeMylea" style="width:100%; background-color: #f8fafc;">
                        @foreach ($FormData as $item)
                            <option value="{{$item['id']}}">{{$item['KPMylea']}} : {{$item['TanggalPanen']}} (Available : {{$item['InStock']}}) @if($item['JenisPanen']=='Kontaminasi') ({{$item['JenisPanen']}}) @endif</option>
                        @endforeach
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
        
            // Fungsi untuk menghitung total dan memperbarui input TotalPenggunaanMylea
            function updateTotal() {
                var total = 0;
        
                // Iterasi melalui semua input jumlah dan menambahkannya ke total
                $("input[name^='data['][name$='[Jumlah]']").each(function () {
                    var value = parseFloat($(this).val()) || 0;
                    total += value;
                });
        
                // Memperbarui nilai input TotalPenggunaanMylea
                $("#TotalPenggunaanMylea").val(total);
            }
        
            // Menambahkan event listener untuk input jumlah
            $(document).on('input', "input[name^='data['][name$='[Jumlah]']", function () {
                updateTotal();
            });
        
            // Menambahkan event listener untuk tombol Tambah
            $("#dynamic-ar").click(function () {
                ++i;
                $("#dynamicAddRemove").append('<tr>' +
                    '<td>' +
                        '<select name="data[' + i + '][KodeMylea]" class="form-control select2-single" id="KodeMylea' + i + '" style="width:100%; background-color: #f8fafc;">' +
                            '@foreach ($FormData as $item)' +
                                ' <option value="{{$item['id']}}">{{$item['KPMylea']}} : {{$item['TanggalPanen']}} (Available : {{$item['InStock']}}) @if($item['JenisPanen']=='Kontaminasi') ({{$item['JenisPanen']}}) @endif</option>' +
                            '@endforeach' +
                        '</select>' +
                    '</td>' +
                    '<td><input type="number" name="data[' + i + '][Jumlah]" class="form-control" /></td>' +
                    '<td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        
                // Menambahkan event listener untuk select2 pada elemen baru
                setTimeout(function () {
                    $("#KodeMylea" + i).select2({
                        theme: "bootstrap4"
                    });
                }, 100);
        
                updateTotal(); // Panggil fungsi updateTotal setelah menambahkan baris baru
            });
        
            // Menambahkan event listener untuk tombol delete
            $(document).on('click', '.remove-input-field', function () {
                $(this).parents('tr').remove();
                updateTotal(); // Panggil fungsi updateTotal setelah menghapus baris
            });
        
            // Menambahkan event listener untuk select2 pada elemen pertama
            $("#KodeMylea").select2({
                theme: "bootstrap4"
            });
        </script>
        
        
        <style>
        </style>
    </div>