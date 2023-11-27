<div class="modal fade" id="EditModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/admin/mylea/produksi-edit') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$data['id']}}">
                <input type="hidden" name="KodeProduksi" value="{{$data['KodeProduksi']}}">
                <div class="row mb-3 ">
                    <label for="TanggalProduksi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Produksi :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="TanggalProduksi" class="form-control form-control-sm  @error('TanggalProduksi') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['TanggalProduksi']}}">
                        @error('TanggalProduksi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="TanggalElus1" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Elus 1 :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="TanggalElus1" class="form-control form-control-sm  @error('TanggalElus1') is-invalid @enderror" id="colFormLabelSm" value="{{$data['TanggalElus']}}">
                        @error('TanggalElus1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm">Jam Mulai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['JamMulai'] }}">
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
                        <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['JamSelesai'] }}">
                        @error('JamSelesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> 
                <div class="row mb-3 ">
                    <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="Jumlah" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['Jumlah'] }}">
                        @error('Jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>      
                <div class="row mb-3 ">
                    <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-5">
                        <input type="text"  name="Keterangan" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['Keterangan'] }}">
                        @error('Keterangan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>   
                <div class="row mb-3 ">
                    <label for="Method" class="col-sm-2 col-form-label col-form-label-sm">Method :</label>
                    <div class="col-sm-5">
                        <select name="Method" class="form-control form-control-sm @error('Method') is-invalid @enderror" id="colFormLabelSm">
                            <option value="Direct" {{ $data['Method'] === 'Direct' ? 'selected' : '' }}>Direct</option>
                            <option value="2 phase" {{ $data['Method'] === '2 phase' ? 'selected' : '' }}>2 phase</option>
                        </select>
                        @error('Method')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Tray" class="col-sm-2 col-form-label col-form-label-sm">Tray :</label>
                    <div class="col-sm-5">
                        <select name="Tray" class="form-control form-control-sm @error('Tray') is-invalid @enderror" id="colFormLabelSm" >
                            <option value="T0" {{ $data['Tray'] === 'T0' ? 'selected' : '' }}>T0</option>
                            <option value="T1" {{ $data['Tray'] === 'T1' ? 'selected' : '' }}>T1</option>
                        </select>
                        @error('Tray')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="SubstrateQty" class="col-sm-2 col-form-label col-form-label-sm">Substrate Qty(kg) :</label>
                    <div class="col-sm-5">
                        <select name="SubstrateQty" class="form-control form-control-sm @error('SubstrateQty') is-invalid @enderror" id="colFormLabelSm" value="{{ old('SubstrateQty') }}" >
                            <option value="2" {{ $data['SubstrateQty'] === 2 ? 'selected' : '' }}>2 kg</option>
                            <option value="3" {{ $data['SubstrateQty'] === 3 ? 'selected' : '' }}>3 kg</option>
                            <option value="4" {{ $data['SubstrateQty'] === 4 ? 'selected' : '' }}>4 kg</option>
                        </select>
                        @error('SubstrateQty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>   
        </div>
        <div class="modal-footer">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>