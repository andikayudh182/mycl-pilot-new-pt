<div class="modal fade" id="KontaminasiModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Kontaminasi {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Tanggal Kontaminasi</th>
                    <th>Kode Baglog</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>No Bibit</th>
                    <th>Kondisi Baglog</th>
                    
                </tr>
                @foreach($data['DataKontaminasi'] as $DataKonta)
                    <tr>
                        <td>{{$DataKonta['TanggalKontaminasi']}}</td>
                        <td>{{$DataKonta['KPBaglog']}}</td>
                        <td>{{$DataKonta['Jumlah']}}</td>
                        <td>{{$DataKonta['Keterangan']}}</td>
                        <td><?php echo $data['NoBibit'];?></td>
                        <td>{{$data['KondisiBaglog']}}</td>
                      
                        <td><a href="{{url('/admin/mylea/report/kontaminasi-delete', ['id'=>$DataKonta['id'],])}}" class="btn btn-primary float-auto">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="modal-footer">
          <a href="{{url('/admin/mylea/report/form-kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}" class="btn btn-primary float-auto">Tambah Data Kontaminasi</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>