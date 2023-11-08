<!-- Modal -->
<div class="modal fade" id="updateModal{{ $PT['id'] }}" tabindex="-2" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Post Treatment</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/operator/post-treatment/proses-post-treatment-submit') }}" method="POST" enctype="multipart/form-data" id="FormPostTreatment">
                @csrf
                <input type="hidden" value="{{$PT['id']}}" name="id">
                <div class="row mb-3 ">
                    <label for="Tanggal" class="col-sm-5 col-form-label col-form-label-sm">Tanggal  :</label>
                    <div class="col-sm-5">
                        <input type="date" id="Tanggal" name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['Tanggal'] }}">
                        @error('Tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamMulai" class="col-sm-5 col-form-label col-form-label-sm">Jam Mulai :</label>
                    <div class="col-sm-5">
                        <input type="time" id="JamMulai" name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['JamMulai'] }}">
                        @error('JamMulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamSelesai" class="col-sm-5 col-form-label col-form-label-sm">Jam Selesai :</label>
                    <div class="col-sm-5">
                        <input type="time" id="JamSelesai" name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['JamSelesai'] }}">
                        @error('JamSelesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Proses" class="col-sm-5 col-form-label col-form-label-sm">Proses :</label>
                    <div class="col-sm-5">
                        <select name="Proses" id="Proses" class="form-control form-control-sm">
                            <option value="Dyeing" {{ $PT['Proses'] === 'Dyeing' ? 'selected' : '' }}>Dyeing</option>
                            <option value="Ferro Sulfat" {{ $PT['Proses'] === 'Ferro Sulfat' ? 'selected' : '' }}>Ferro Sulfat</option>
                            <option value="Fixing" {{ $PT['Proses'] === 'Fixing' ? 'selected' : '' }}>Fixing</option>
                            <option value="Fat Liquor" {{ $PT['Proses'] === 'Fat Liquor' ? 'selected' : '' }}>Fat Liquor</option>
                            <option value="Moisturizing" {{ $PT['Proses'] === 'Moisturizing' ? 'selected' : '' }}>Moisturizing</option>
                            <option value="Drying" {{ $PT['Proses'] === 'Drying' ? 'selected' : '' }}>Drying</option>
                            <option value="Amplas" {{ $PT['Proses'] === 'Amplas' ? 'selected' : '' }}>Amplas</option>
                            <option value="Clearing" {{ $PT['Proses'] === 'Clearing' ? 'selected' : '' }}>Clearing</option>
                            <option value="Filling" {{ $PT['Proses'] === 'Filling' ? 'selected' : '' }}>Filling</option>
                            <option value="Coating 1" {{ $PT['Proses'] === 'Coating 1' ? 'selected' : '' }}>Coating 1</option>
                            <option value="Coating 2" {{ $PT['Proses'] === 'Coating 2' ? 'selected' : '' }}>Coating 2</option>
                            <option value="Coating 3" {{ $PT['Proses'] === 'Coating 3' ? 'selected' : '' }}>Coating 3</option>
                            <option value="Finishing" {{ $PT['Proses'] === 'Finishing' ? 'selected' : '' }}>Finishing</option>
                        </select>
                        
                        @error('Proses')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Notes" class="col-sm-5 col-form-label col-form-label-sm">Notes :</label>
                    <div class="col-sm-5">
                        <input type="text" id="Notes" name="Notes" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['Notes'] }}">
                        @error('Notes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Jumlah" class="col-sm-5 col-form-label col-form-label-sm">Jumlah :</label>
                    <div class="col-sm-5">
                        <input type="number" id="Jumlah" name="Jumlah" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['Jumlah'] }}">
                        @error('Jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Reject" id="Reject" class="col-sm-5 col-form-label col-form-label-sm">Reject :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="Reject" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $PT['Reject'] }}">
                        @error('Reject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto"> 
            </form> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
  
 