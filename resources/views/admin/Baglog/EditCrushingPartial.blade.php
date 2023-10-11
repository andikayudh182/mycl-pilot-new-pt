<div class="modal fade" id="exampleModal{{$data1['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Crushing</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if(count($data1['Crushing']) === 0)
                <h5>Belum ada data crushing</h5>
            @endif
            @foreach($data1['Crushing'] as $crushing)

            <form method="POST" action="{{url('/admin/baglog/report/crushing-update')}}" class="m-5">
                @csrf
                <input type="hidden"  name="id" value="{{$crushing['id']}}">
                @csrf
                <div class="row mb-3 ">
                    <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                    <div class="col-sm-5">
                        <input type="text"  name="KodeProduksi" class="form-control form-control-sm  @error('KodeProduksi') is-invalid @enderror" id="colFormLabelSm" value="{{ $data1['KodeProduksi'] }}">
                        @error('KodeProduksi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="TanggalCrushing" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Crushing :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="TanggalCrushing" class="form-control form-control-sm  @error('TanggalCrushing') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['TanggalCrushing'] }}">
                        @error('TanggalCrushing')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['JamMulai'] }}">
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
                        <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['JamSelesai'] }}">
                        @error('JamSelesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="KondisiBaglog" class="col-sm-2 col-form-label col-form-label-sm">KondisiBaglog :</label>
                    <div class="col-sm-5">
                        <select name="KondisiBaglog" class="form-control form-control-sm" id="colFormLabelSm" >
                                    <option value="Semua tumbuh sampai putih">Semua tumbuh sampai putih</option>
                                    <option value="Semua tidak tumbuh sama sekali">Semua tidak tumbuh sama sekali</option>
                                    <option value="Semua tumbuh tapi tidak merata">Semua tumbuh tapi tidak merata</option>
                                    <option value="Sebagian tumbuh, sebagian tidak">Sebagian tumbuh, sebagian tidak</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahBaglogPutih" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Putih :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglogPutih" class="form-control form-control-sm  @error('JumlahBaglogPutih') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['JumlahBaglogPutih'] }}">
                        @error('JumlahBaglogPutih')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahBaglogTidakTumbuh" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Tidak Tumbuh :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglogTidakTumbuh" class="form-control form-control-sm  @error('JumlahBaglogTidakTumbuh') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['JumlahBaglogTidakTumbuh'] }}">
                        @error('JumlahBaglogTidakTumbuh')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JumlahBaglogTidakMerata" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Tumbuh Tidak Merata:</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglogTidakMerata" class="form-control form-control-sm  @error('JumlahBaglogTidakMerata') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['JumlahBaglogTidakMerata'] }}">
                        @error('JumlahBaglogTidakMerata')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="TotalBaglog" class="col-sm-2 col-form-label col-form-label-sm">Qty Baglog Total :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="TotalBaglog" class="form-control form-control-sm  @error('TotalBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ $crushing['TotalBaglog'] }}">
                        @error('TotalBaglog')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
            </form>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>