@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="/operator_dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="/operator/baglog">Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Baglog Recipe Calculator</li>
            </ol>
        </nav>
    </div>

    <div class="m-5">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <h3>Baglog Recipe Calculator</h3>
        </div>
        </div>
        <form method="POST" action="{{url('/operator/baglog/recipe-submit', ['id' => $id,])}}" class="m-5">
            @csrf
            <div class="row mb-3">
                <label for="Type" class="col-sm-2 col-form-label col-form-label-sm">Jenis Resep :</label>
                <div class="col-sm-5">
                    <select name="Type" class="form-control form-control-sm @error('Type') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Type') }}" required>
                        <option value="" disabled selected>Pilih Jenis Resep</option>
                        <option value="STP20">STP20</option>
                        <option value="FTP15">FTP15</option>
                        <option value="TTP15">TTP15</option>
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
                    <input type="number" step="any" name="TotalBags" class="form-control form-control-sm  @error('TotalBags') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalKeluar') }}">
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
                    <input type="number" step="any" name="WeightperBag" class="form-control form-control-sm  @error('WeightperBag') is-invalid @enderror" id="colFormLabelSm" value="{{ old('WeightperBag') }}">
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
                    <input type="number" step="any" name="MCSKayu" class="form-control form-control-sm @error('MCSKayu') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCSKayu') }}">
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
                    <input type="text" name="NoKarungSKayu" class="form-control form-control-sm @error('NoKarungSKayu') is-invalid @enderror" id="colFormLabelSm">
                    @error('NoKarungSKayu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="SKayu" class="col-sm-2 col-form-label col-form-label-sm">Serbuk Kayu (kg):</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="SKayu" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                </div>
            </div>
            <h4>Bahan</h4>
            <div class="row mb-3 ">
                <label for="MCCaCO3" class="col-sm-2 col-form-label col-form-label-sm">MC CaCO3 :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="MCCaCO3" class="form-control form-control-sm @error('MCCaCO3') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCCaCO3') }}">
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
                    <input type="number" step="any" name="CaCO3" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="MCPollard" class="col-sm-2 col-form-label col-form-label-sm">MC Pollard :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="MCPollard" class="form-control form-control-sm @error('MCPollard') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCPollard') }}">
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
                    <input type="number" step="any" name="Pollard" class="form-control form-control-sm " id="colFormLabelSm" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="MCTapioka" class="col-sm-2 col-form-label col-form-label-sm">MC Tapioka :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="MCTapioka" class="form-control form-control-sm @error('MCTapioka') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCTapioka') }}">
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
                    <input type="number" step="any" name="Tapioka" id="Tapioka" class="form-control form-control-sm"  disabled>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Air" class="col-sm-2 col-form-label col-form-label-sm">Air (kg):</label>
                <div class="col-sm-4">
                    <input type="number" step="any" name="Air" class="form-control form-control-sm @error('Air') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Air') }}" disabled>
                </div>
            </div>
            <input type="button" id="Calculate" name="Calculate" value="Calculate" class="btn btn-primary float-auto">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </div>
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
        TypeSelect = document.querySelector('select[name="Type"]');

        Calculate.addEventListener('click', function(){
            var percentageSkayu, percentagePollard;
            if (TypeSelect.value === 'FTP15' || TypeSelect.value === 'TTP15') {
                percentageSKayu = 0.72;
                percentagePollard = 0.15;
            }
            else {
                percentageSKayu = 0.67;
                percentagePollard = 0.20;
            }
            W = WeightperBag.value;
            T = TotalBags.value;
            x = 0.35 * W;
            WCaCO3 = x * 0.03 / (100 - CaCO3.value) / 10;
            WSKayu = x * percentageSKayu/ (100 - SKayu.value) / 10;
            WPollard = x * percentagePollard/ (100 - Pollard.value) / 10;
            WTapioka = x * 0.10 / (100 - Tapioka.value) / 10;
            TotalW =  WCaCO3 + WSKayu + WPollard + WTapioka;
            TotalD = (x * 0.03 + x * percentageSKayu + x * percentagePollard+ x * 0.10)/1000;
            WAir = (0.65 * W)/1000 - (TotalW - (x/1000));
            document.querySelector('input[name="Tapioka"]').value = (WTapioka * T).toFixed(3);
            document.querySelector('input[name="Pollard"]').value = (WPollard * T).toFixed(3);
            document.querySelector('input[name="CaCO3"]').value = (WCaCO3  * T).toFixed(3);
            document.querySelector('input[name="SKayu"]').value = (WSKayu  * T).toFixed(3);
            document.querySelector('input[name="Air"]').value = (WAir * T).toFixed(3);
        });

    </script>
@endsection

