<div class="modal fade" id="FormRebusModal{{$data['id']}}" tabindex="-1" aria-labelledby="FormRebusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{$data['KPMylea']}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/admin/post-treatment/data-panen/submit-rebus')}}" method="POST">
                @csrf
                <input type="hidden"  name="PanenID" value="{{$data['id']}}">
                <div class="row mb-3 ">
                    <label for="Tanggal" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm">
                        @error('Tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah  :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="Jumlah" class="form-control form-control-sm  @error('Jumlah') is-invalid @enderror" id="colFormLabelSm">
                        @error('Jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>