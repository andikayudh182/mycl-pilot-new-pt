<div class="modal fade" id="updateModal{{$data['id']}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$data['Batch']}} / {{ $data['TanggalPostTreatment'] }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <h4> Update Size </h4>
            <form action="{{route('UpdateCuringSize')}}" method="POST">
                    @csrf
                    <input type="hidden"  name="PT_ID" value="{{$data['PT_ID']}}">
                    <div class="row mb-3 ">
                        <label for="Tanggal" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Pengerjaan</label>
                        <label for="Tanggal" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="date"  name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['TanggalPengerjaan'] }} required>
                            @else
                                <input type="date"  name="TanggalPengerjaan" class="form-control form-control-sm  @error('TanggalPengerjaan') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('TanggalPengerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="Warna" class="col-sm-4 col-form-label col-form-label-sm">Warna</label>
                        <label for="Warna" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                            <select name="Warna" id="Warna" class="form-control form-control-sm @error('Warna') is-invalid @enderror" id="colFormLabelSm" required>
                               
                                <option value="Original" {{ $data['Curing'][0]['Warna'] == 'Original' ? 'selected' : '' }}>Original</option>
                                <option value="Black" {{ $data['Curing'][0]['Warna'] == 'Black' ? 'selected' : '' }}>Black</option>
                            </select>
                             @else
                                <select name="Warna" id="Warna" class="form-control form-control-sm @error('Warna') is-invalid @enderror" id="colFormLabelSm" required>
                                    <option value="" {{ empty($data['Curing'][0]['Warna']) ? 'selected' : '' }} disabled>Pilih Warna</option>
                                    <option value="Original">Original</option>
                                    <option value="Black">Black</option>
                                </select>
                            @endif
                            @error('Warna')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="SizeSatu" class="col-sm-4 col-form-label col-form-label-sm">Grade A (26x46)</label>
                        <label for="SizeSatu" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="number"  name="SizeSatu" class="form-control form-control-sm  @error('SizeSatu') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['SizeSatu'] }} required>
                            @else
                                <input type="number"  name="SizeSatu" class="form-control form-control-sm  @error('SizeSatu') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('SizeSatu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="SizeDua" class="col-sm-4 col-form-label col-form-label-sm">Grade B (20x40)</label>
                        <label for="SizeDua" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="number"  name="SizeDua" class="form-control form-control-sm  @error('SizeDua') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['SizeDua'] }} required>
                            @else
                                <input type="number"  name="SizeDua" class="form-control form-control-sm  @error('SizeDua') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('SizeDua')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="SizeTiga" class="col-sm-4 col-form-label col-form-label-sm">Grade C (15x30)</label>
                        <label for="SizeTiga" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="number"  name="SizeTiga" class="form-control form-control-sm  @error('SizeTiga') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['SizeTiga'] }} required>
                            @else
                                <input type="number"  name="SizeTiga" class="form-control form-control-sm  @error('SizeTiga') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('SizeTiga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="SizeTiga" class="col-sm-4 col-form-label col-form-label-sm"> Grade D</label>
                        <label for="SizeTiga" class="col-sm-1 col-form-label col-form-label-sm">:</label>
                        <div class="col-sm-6">
                            @if(isset($data['Curing'][0]))
                                <input type="number"  name="SizeEmpat" class="form-control form-control-sm  @error('SizeEmpat') is-invalid @enderror" id="colFormLabelSm" value={{ $data['Curing'][0]['SizeEmpat'] }} required>
                            @else
                                <input type="number"  name="SizeEmpat" class="form-control form-control-sm  @error('SizeEmpat') is-invalid @enderror" id="colFormLabelSm" required>
                            @endif
                            
                            @error('SizeEmpat')
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