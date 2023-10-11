<div class="modal fade" id="DeleteModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
          <a href="{{ url('/admin/mylea/report/data-produksi-delete', ['id' => $data['id'], 'KPMylea' => $data['KodeProduksi']]) }}" class="btn btn-danger float-auto">Delete</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>