
    <h3>Form Post Treatment</h3>
    <form action="{{ url('/operator/post-treatment/proses-post-treatment-submit') }}" method="POST" enctype="multipart/form-data" id="FormPostTreatment">
        @csrf
        <input type="hidden" value="{{$data['id']}}" name="PT_ID">
        <div class="row mb-3 ">
            <label for="id" class="col-sm-5 col-form-label col-form-label-sm">ID  :</label>
            <div class="col-sm-5">
                <input type="text"  id="id" name="id" class="form-control form-control-sm  @error('id') is-invalid @enderror" id="colFormLabelSm" value="0" readonly="readonly">
                @error('id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-5 col-form-label col-form-label-sm">Tanggal  :</label>
            <div class="col-sm-5">
                <input type="date" id="Tanggal" name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
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
                <input type="time" id="JamMulai" name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamMulai') }}">
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
                <input type="time" id="JamSelesai" name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JamSelesai') }}">
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
                    <option value="Rebus">Rebus</option>
                    <option value="Scouring">Scouring</option>
                    <option value="Tingi">Tingi</option>
                    <option value="Ferro Sulfat">Ferro Sulfat</option>
                    <option value="Fat Liquor">Fat Liquor</option>
                    <option value="Fixing">Fixing</option>
                    <option value="PEG">PEG</option>
                    <option value="Drying">Drying</option>
                    <option value="Reinforce + Roll Press">Reinforce + Roll Press</option>
                    <option value="Amplas">Amplas</option>
                    <option value="Clearing">Clearing</option>
                    <option value="Stucco + Filling">Stucco + Filling</option>
                    <option value="Coating 1">Coating 1</option>
                    <option value="Coating 2">Coating 2</option>
                    <option value="Coating 3">Coating 3</option>
                    <option value="Plating + Tokonole">Plating + Tokonole</option>
                </select>
                @error('Proses')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Jumlah" class="col-sm-5 col-form-label col-form-label-sm">Jumlah :</label>
            <div class="col-sm-5">
                <input type="number" id="Jumlah" name="Jumlah" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Jumlah') }}">
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
                <input type="number"  name="Reject" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Reject') }}">
                @error('Reject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto"> 
    </form>