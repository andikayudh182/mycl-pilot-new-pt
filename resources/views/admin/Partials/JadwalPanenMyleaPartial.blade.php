<div class="collapse" id="collapseExample">
    <div class="card card-body">
        @php
            use Carbon\Carbon;
            $date = Carbon::Now();
            $PanenDate = substr($date, 0, 7);
            if(isset($_GET['TanggalPanen'])){
                $PanenDate = $_GET['TanggalPanen'];
            }
        @endphp
        <div>
            <form method="GET" action="">
                <div class="row mb-3">
                    <label for="TanggalPanen" class="col-sm-0 col-form-label col-form-label-sm"></label>
                    <div class="col-sm-4">
                        <select name="TanggalPanen" class="form-control">
                            @if(isset($_GET['TanggalPanen']))
                                <option value="{{$_GET['TanggalPanen']}}" selected>{{$_GET['TanggalPanen']}}</option>
                            @endif
                            @foreach($TanggalPanen->sortByDesc('JadwalPanen', SORT_NATURAL) as $data)
                                <option value="{{$data['JadwalPanen']}}">{{$data['JadwalPanen']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="Submit" name="Submit" class="col-sm-1 btn btn-primary m-2" value="1">Submit</button>
                </div>
            </form>
        </div>
      <table class="table" width="75%">
        <tr>
            <th>Kode Produksi</th>
            <th>Tanggal Panen</th>
            <th>In Stock</th>
        </tr>
        @foreach($MyleaPanen->sortByDesc('JadwalPanen', SORT_NATURAL) as $item)
            @if(substr($item['JadwalPanen'], 0, 7) == $PanenDate)
            <tr>
                <td>{{$item['KodeProduksi']}}</td>
                <td>{{$item['JadwalPanen']}}</td>
                <td>{{$item['InStock']}}</td>
            </tr>
            @endif
        @endforeach
      </table>
    </div>
</div>