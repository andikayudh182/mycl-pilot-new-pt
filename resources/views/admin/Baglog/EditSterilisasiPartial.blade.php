<div class="modal fade" id="exampleModal{{$data1['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Sterilisasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('/admin/baglog/sterilisasi-update')}}" class="m-5">
                @csrf
                <input type="hidden"  name="id" value="{{$data1['id']}}">
                <div class="row mb-3 ">
                    <label for="TanggalPengerjaan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['TanggalPengerjaan'] }}">
                        @error('TanggalPengerjaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Batch" class="col-sm-2 col-form-label col-form-label-sm">Batch :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['Batch'] }}">
                        @error('Batch')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="NoAutoclave" class="col-sm-2 col-form-label col-form-label-sm">No Autoclave :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="NoAutoclave" class="form-control form-control-sm  @error('NoAutoclave') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['NoAutoclave'] }}">
                        @error('NoAutoclave')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['JamMulai'] }}">
                        @error('JamMulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamSelesai" class="col-sm-2 col-form-label col-form-label-sm">Jam Selesai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['JamSelesai'] }}">
                        @error('JamSelesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['JumlahBaglog'] }}">
                        @error('JumlahBaglog')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Kondisi" class="col-sm-2 col-form-label col-form-label-sm">Kondisi :</label>
                    <div class="col-sm-5">
                        <select name="Kondisi" class="form-control form-control-sm" id="colFormLabelSm" >
                                <option value="{{$data1['Kondisi']}}">{{$data1['Kondisi']}}</option>
                                <option value="Sesuai">Sesuai</option>
                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahBaglogBerlubang" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog Berlubang :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglogBerlubang" class="form-control form-control-sm  @error('JumlahBaglogBerlubang') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['JumlahBaglogBerlubang'] }}">
                        @error('JumlahBaglogBerlubang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahTapeTidakHitam" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Autoclave Tape Tidak Hitam:</label>
                    <div class="col-sm-5">
                        <input type="text"  name="JumlahTapeTidakHitam" class="form-control form-control-sm  @error('JumlahTapeTidakHitam') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['JumlahTapeTidakHitam'] }}">
                    </div>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>