<div class="modal fade" id="updateJumlahMylea{{$Mylea['id']}}" tabindex="-1" aria-labelledby="ForkKerikModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{$Mylea['KPMylea']}}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
            <form action="{{url('/admin/post-treatment-details/update-jumlah-mylea')}}" method="POST">
                @csrf
                <input type="hidden"  name="id" value="{{$Mylea['id']}}">
                <div class="row mb-3 ">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah</label>
                    <div class="col-sm-5">
                        <input type="number"  name="Jumlah" class="form-control form-control-sm  @error('Jumlah') is-invalid @enderror" id="colFormLabelSm" value="{{$Mylea['Jumlah']}}" >
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>