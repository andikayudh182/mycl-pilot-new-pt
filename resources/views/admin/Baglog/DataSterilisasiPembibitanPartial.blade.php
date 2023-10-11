<div class="modal fade" id="SterilisasiModal{{$data1['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Pemakaian Baglog {{$data1['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Tanggal Sterilisasi</th>
                    <th>Batch</th>
                    <th>Jumlah</th>
                </tr>
                @if(isset($data1['DataSterilisasi']))
                @foreach($data1['DataSterilisasi'] as $DataSteril)
                    <tr>
                        <td>{{$DataSteril['TanggalPengerjaan']}}</td>
                        <td>{{$DataSteril['Batch']}}</td>
                        <td>{{$DataSteril['Jumlah']}}</td>
                    </tr>
                @endforeach
                @endif
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>