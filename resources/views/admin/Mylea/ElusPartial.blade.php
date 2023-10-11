<div class="modal fade" id="ElusModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Elus {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Tanggal ELus</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Jumlah</th>
                </tr>
                @foreach($data['DataElus'] as $DataElus)
                    <tr>
                        <td>{{$DataElus['TanggalElus']}}</td>
                        <td>{{$DataElus['JamMulai']}}</td>
                        <td>{{$DataElus['JamSelesai']}}</td>
                        <td>{{$DataElus['Jumlah']}}</td>
                        <td><a href="{{url('/admin/mylea/report/elus-delete', ['id'=>$DataElus['id'],])}}" class="btn btn-primary float-auto">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="modal-footer">
            <a href="{{url('/admin/mylea/report/form-elus', ['KodeProduksi'=>$data['KodeProduksi'],])}}" class="btn btn-primary float-auto">Tambah Data Elus</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>