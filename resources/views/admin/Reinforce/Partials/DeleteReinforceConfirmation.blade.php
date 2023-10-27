<div class="modal fade" id="deleteConfirmationModal{{ $data['id'] }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Reinforce</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin menghapus data reinforce dengan id {{ $data['id'] }} ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a class="btn btn-danger" href="{{route('ReinforceDelete', ['id'=>$data['id'],])}}">Delete</a>
        </div>
      </div>
    </div>
  </div>