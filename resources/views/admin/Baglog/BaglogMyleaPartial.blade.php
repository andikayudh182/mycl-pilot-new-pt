<div class="modal fade" id="BaglogMyleaModal{{$data1['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Pemakaian Baglog {{$data1['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Kode Mylea</th>
                    <th>Jumlah</th>
                </tr>
                @if(isset($data1['mylea']))
                @foreach($data1['mylea'] as $DataMylea)
                    <tr>
                        <td>{{$DataMylea['KPMylea']}}</td>
                        <td>{{$DataMylea['JumlahBaglog']}}</td>
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