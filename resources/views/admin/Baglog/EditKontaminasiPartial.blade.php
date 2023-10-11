<div class="modal fade" id="exampleModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Kontaminasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('/admin/baglog/report/konta-update')}}" class="m-5">
                @csrf
                <input type="hidden"  name="id" value="{{$data['id']}}">
                <div class="row mb-3 ">
                    <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                    <div class="col-sm-5">
                        <input type="text" name="KodeProduksi" value="<?php echo $data['KodeProduksi'];?>" class="Disabled input example form-control-sm">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="NoBibit" class="col-sm-2 col-form-label col-form-label-sm">Nomor Bibit :</label>
                    <div class="col-sm-5">
                        <input type="text" name="NoBibit" class="form-control form-control-sm  @error('NoBibit') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['NoBibit'] }}">
                        @error('NoBibit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>       
                <div class="row mb-3 ">
                    <label for="JumlahKonta" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Konta :</label>
                    <div class="col-sm-5">
                        <input type="number" name="JumlahKonta" class="form-control form-control-sm  @error('JumlahKonta') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['JumlahKonta'] }}">
                        @error('JumlahKonta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="TanggalKonta" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Kontaminasi :</label>
                    <div class="col-sm-5">
                        <input type="date" name="TanggalKonta" class="form-control form-control-sm  @error('TanggalKonta') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['TanggalKonta'] }}">
                        @error('TanggalKonta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-5">
                        <input type="text" name="Keterangan" class="form-control form-control-sm  @error('Keterangan') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['Keterangan'] }}">
                        @error('Keterangan')
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>