<div class="modal fade" id="exampleModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Resep Mixing</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('/operator/baglog/edit-resep')}}" class="m-5">
                @csrf
                <input type="hidden" name="id" value="{{$data['id']}}"/>
                <div class="row mb-3">
                    <label for="Type" class="col-sm-2 col-form-label col-form-label-sm">Jenis Resep :</label>
                    <div class="col-sm-5">
                        <select name="Type" class="form-control form-control-sm @error('Type') is-invalid @enderror" id="colFormLabelSm" required>
                            <option value="" disabled {{ !$data['Type'] ? 'selected' : '' }}>Pilih Jenis Resep</option>
                            <option value="STP20" {{ $data['Type'] == 'STP20' ? 'selected' : '' }}>STP20</option>
                            <option value="FTP15" {{ $data['Type'] == 'FTP15' ? 'selected' : '' }}>FTP15</option>
                            <option value="TTP15" {{ $data['Type'] == 'TTP15' ? 'selected' : '' }}>TTP15</option>
                        </select>
                        @error('Type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3 ">
                    <label for="TotalBags" class="col-sm-2 col-form-label col-form-label-sm">Total Baglog :</label>
                    <div class="col-sm-5">
                        <input type="number" step="any" name="TotalBags" class="form-control form-control-sm  @error('TotalBags') is-invalid @enderror" id="colFormLabelSm" value="{{$data['TotalBags']}}">
                        @error('TotalBags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="WeightperBag" class="col-sm-2 col-form-label col-form-label-sm">Berat per Baglog (gram):</label>
                    <div class="col-sm-5">
                        <input type="number" step="any" name="WeightperBag" class="form-control form-control-sm  @error('WeightperBag') is-invalid @enderror" id="colFormLabelSm" value="{{$data['BeratBaglog']}}">
                        @error('WeightperBag')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="MCSKayu" class="col-sm-2 col-form-label col-form-label-sm">MC Serbuk Kayu :</label>
                    <div class="col-sm-1">
                        <input type="number" step="any" name="MCSKayu" class="form-control form-control-sm @error('MCSKayu') is-invalid @enderror" id="colFormLabelSm" value="{{$data['MCSKayu']}}">
                        @error('MCSKayu')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="NoKarungSKayu" class="col-sm-2 col-form-label col-form-label-sm">No Karung Serbuk Kayu :</label>
                    <div class="col-sm-2">
                        <input type="text" name="NoKarungSKayu" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['NoKarungSKayu']}}">
                    </div>
                    <label for="SKayu" class="col-sm-2 col-form-label col-form-label-sm">Serbuk Kayu (kg):</label>
                    <div class="col-sm-2">
                        <input type="number" step="any" name="SKayu" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['SKayu']}}">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="MCHickory" class="col-sm-2 col-form-label col-form-label-sm">MC Hickory :</label>
                    <div class="col-sm-1">
                        <input type="number" step="any" name="MCHickory" class="form-control form-control-sm @error('MCHickory') is-invalid @enderror" id="colFormLabelSm" value="" disabled>
                        @error('MCHickory')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="Hickory" class="col-sm-2 col-form-label col-form-label-sm">Hickory (kg):</label>
                    <div class="col-sm-2">
                        <input type="number" step="any" name="Hickory" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                    </div>
                </div>
                <h4>Bahan</h4>
                <div class="row mb-3 ">
                    <label for="MCCaCO3" class="col-sm-2 col-form-label col-form-label-sm">MC CaCO3 :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCCaCO3" class="form-control form-control-sm @error('MCCaCO3') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['MCKapur'] }}">
                        @error('MCCaCO3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="CaCO3" class="col-sm-2 col-form-label col-form-label-sm">CaCO3 (kg):</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="CaCO3" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['Kapur']}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="MCPollard" class="col-sm-2 col-form-label col-form-label-sm">MC Pollard :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCPollard" class="form-control form-control-sm @error('MCPollard') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['MCPollard'] }}">
                        @error('MCPollard')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror            
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="Pollard" class="col-sm-2 col-form-label col-form-label-sm">Pollard (kg):</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="Pollard" class="form-control form-control-sm " id="colFormLabelSm" value="{{$data['Pollard']}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="MCTapioka" class="col-sm-2 col-form-label col-form-label-sm">MC Tapioka :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCTapioka" class="form-control form-control-sm @error('MCTapioka') is-invalid @enderror" id="colFormLabelSm" value="{{ $data['MCTapioka'] }}">
                        @error('MCTapioka')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror            
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="Tapioka" class="col-sm-2 col-form-label col-form-label-sm">Tapioka (kg):</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="Tapioka" id="Tapioka" class="form-control form-control-sm" value="{{$data['Tapioka']}}">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Air" class="col-sm-2 col-form-label col-form-label-sm">Air (kg):</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="Air" class="form-control form-control-sm @error('Air') is-invalid @enderror" id="colFormLabelSm" value="{{$data['Air'] }}">
                    </div>
                </div>
                <input type="button" id="Calculate" name="Calculate" value="Calculate" class="btn btn-primary float-auto">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
            <script language="javascript" type="text/javascript">
                SKayu = document.querySelector('input[name="MCSKayu"]');
                Hickory = document.querySelector('input[name="MCHickory"]');
                CaCO3 = document.querySelector('input[name="MCCaCO3"]');
                Pollard = document.querySelector('input[name="MCPollard"]');
                Tapioka = document.querySelector('input[name="MCTapioka"]');
                WeightperBag = document.querySelector('input[name="WeightperBag"]');
                TotalBags = document.querySelector('input[name="TotalBags"]');
                Calculate = document.getElementById("Calculate");
        
                Calculate.addEventListener('click', function(){
                    W = WeightperBag.value;
                    T = TotalBags.value;
                    x = 0.35 * W;
                    WCaCO3 = x * 0.03 / (100 - CaCO3.value) / 10;
                    WSKayu = x * 0.67 / (100 - SKayu.value) / 10;
                    WPollard = x * 0.20 / (100 - Pollard.value) / 10;
                    WTapioka = x * 0.10 / (100 - Tapioka.value) / 10;
                    TotalW =  WCaCO3 + WSKayu + WPollard + WTapioka;
                    TotalD = (x * 0.03 + x * 0.67 + x * 0.20 + x * 0.10)/1000;
                    WAir = (0.65 * W)/1000 - (TotalW - (x/1000));
                    document.querySelector('input[name="Tapioka"]').value = (WTapioka * T).toFixed(3);
                    document.querySelector('input[name="Pollard"]').value = (WPollard * T).toFixed(3);
                    document.querySelector('input[name="CaCO3"]').value = (WCaCO3  * T).toFixed(3);
                    document.querySelector('input[name="SKayu"]').value = (WSKayu  * T).toFixed(3);
                    document.querySelector('input[name="Air"]').value = (WAir * T).toFixed(3);
                });
        
            </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>