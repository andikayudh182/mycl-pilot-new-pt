    <p>
      <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Filter
      </a>
    </p>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <form action="{{url('/admin/mylea/report')}}" method="GET">
            <div id="FormDate">
                <div class="row mb-3 ">
                    <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
                    <div class="col-sm-5">
                        <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAwal'])){{$_GET['TanggalAwal']}}@endif" required>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
                    <div class="col-sm-5">
                        <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAkhir'])){{$_GET['TanggalAkhir']}}@endif" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                    <div class="col-sm-5">
                        <input type="text" name="KodeProduksi" value="@if(isset($_GET['KodeProduksi'])){{$_GET['KodeProduksi']}}@endif" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-5">
                        <input type="text" name="Keterangan" value="@if(isset($_GET['Keterangan'])){{$_GET['Keterangan']}}@endif" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="JumlahTray" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Tray :</label>
                    <div class="col-sm-1">
                        <select name="JumlahTrayOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['JumlahTrayOperator']))
                            <option value="{{$_GET['JumlahTrayOperator']}}" selected>{{$_GET['JumlahTrayOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="JumlahTrayNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['JumlahTrayNumber'])){{$_GET['JumlahTrayNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Kontaminasi" class="col-sm-2 col-form-label col-form-label-sm">Kontaminasi :</label>
                    <div class="col-sm-1">
                        <select name="KontaminasiOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['KontaminasiOperator']))
                            <option value="{{$_GET['KontaminasiOperator']}}" selected>{{$_GET['KontaminasiOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="KontaminasiNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['KontaminasiNumber'])){{$_GET['KontaminasiNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="PersenKonta" class="col-sm-2 col-form-label col-form-label-sm">Persentase Konta :</label>
                    <div class="col-sm-1">
                        <select name="PersenKontaOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['PersenKontaOperator']))
                            <option value="{{$_GET['PersenKontaOperator']}}" selected>{{$_GET['PersenKontaOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="PersenKontaNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['PersenKontaNumber'])){{$_GET['PersenKontaNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Panen" class="col-sm-2 col-form-label col-form-label-sm">Panen :</label>
                    <div class="col-sm-1">
                        <select name="PanenOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['PanenOperator']))
                            <option value="{{$_GET['PanenOperator']}}" selected>{{$_GET['PanenOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="PanenNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['PanenNumber'])){{$_GET['PanenNumber']}}@endif">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="InStock" class="col-sm-2 col-form-label col-form-label-sm">In Stock :</label>
                    <div class="col-sm-1">
                        <select name="InStockOperator" class="form-control">
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>
                            @if(isset($_GET['InStockOperator']))
                            <option value="{{$_GET['InStockOperator']}}" selected>{{$_GET['InStockOperator']}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="InStockNumber" placeholder="Number" class="form-control" value="@if(isset($_GET['InStockNumber'])){{$_GET['InStockNumber']}}@endif">
                    </div>
                </div>
                <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
            </div>
        </form>
      </div>
    </div>

    <script>
        var el = document.getElementById('ColumnSelection');

        var Tanggal = document.getElementById('FormDate');
        var FormNumber = document.getElementById('FormNumber');
        var Search = document.getElementById('FormSearch');

        $(document).ready(function() {
            //Search.style.display = '';
            //FormNumber.style.display = 'none';
            //Tanggal.style.display = 'none';

        });

        el.addEventListener('change', function handleChange(event) {
        if (event.target.value === 'KodeProduksi' || event.target.value == 'Keterangan') {
            Search.style.display = '';
            FormNumber.style.display = 'none';
            Tanggal.style.display = 'none';
        } else if (event.target.value === 'TanggalProduksi') {
            Search.style.display = 'none';
            FormNumber.style.display = 'none';
            Tanggal.style.display = '';
        } else if (event.target.value === 'Jumlah' || event.target.value === 'Konta' || event.target.value === 'PersenKonta' || event.target.value === 'Panen' || event.target.value === 'InStock') {
            Search.style.display = 'none';
            FormNumber.style.display = '';
            Tanggal.style.display = 'none';
        }

        });
    </script>
    

