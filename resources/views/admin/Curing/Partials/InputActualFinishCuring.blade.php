<div class="modal fade" id="exampleModalActual{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$data['Batch']}} / {{ $data['TanggalPostTreatment'] }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <h4> Update Actual Finish Curing</h4>
            <form action="{{route('UpdateActualFinishCuring')}}" method="POST">
                    @csrf
                    <input type="hidden"  name="PT_ID" value="{{$data['PT_ID']}}">
                    <div class="row mb-3 ">
                        <label for="Tanggal" class="col-sm-5 col-form-label col-form-label-sm">Tanggal Actual Finish Curing :</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="date"  name="ActualFinishCuring" class="form-control form-control-sm  @error('ActualFinishCuring') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['ActualFinishCuring'] }} required>
                            @else
                                <input type="date"  name="ActualFinishCuring" class="form-control form-control-sm  @error('ActualFinishCuring') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('ActualFinishCuring')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Submit">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
            </form>
      </div>
    </div>
  </div>