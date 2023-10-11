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
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="d-flex justify-content-center">
            <h3>Baglog Recipe Calculator</h3>
        </div>
        <!---
        <div class="m-3">
            <h5>Kalkulator Pencampuran Bahan</h5>
            <form method="POST">
                @csrf
                <div class="row mb-3 ">
                    <label for="MCTarget" class="col-sm-2 col-form-label col-form-label-sm">MC Target :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCTarget" class="form-control form-control-sm @error('MCTarget') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCTarget') }}">
                        @error('MCTarget')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="BeratTarget" class="col-sm-2 col-form-label col-form-label-sm">Berat Target :</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="BeratTarget" class="form-control form-control-sm" id="colFormLabelSm">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="MCSisa" class="col-sm-2 col-form-label col-form-label-sm">MC Bahan Sisa :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCSisa" class="form-control form-control-sm @error('MCSisa') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCSisa') }}">
                        @error('MCSisa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror            
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="BeratSisa" class="col-sm-2 col-form-label col-form-label-sm">Berat Bahan Sisa :</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="BeratSisa" class="form-control form-control-sm " id="colFormLabelSm">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="MCBaru" class="col-sm-2 col-form-label col-form-label-sm">MC Bahan Baru :</label>
                    <div class="col-sm-3">
                        <input type="number" step="any" name="MCBaru" class="form-control form-control-sm @error('MCBaru') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCBaru') }}">
                        @error('MCBaru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror            
                    </div>
                    <div class="col-sm-1">
                        <p>%</p>
                    </div>
                    <label for="BeratBaru" class="col-sm-2 col-form-label col-form-label-sm">Berat Bahan Baru :</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" name="BeratBaru" id="BeratBaru" class="form-control form-control-sm"  disabled>
                    </div>
                </div>
                <input type="button" id="CalculateBahan" name="CalculateBahan" value="Calculate" class="btn btn-primary float-auto">
            </form>
            <hr style="border-top: 2px solid #999;">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
            <script language="javascript" type="text/javascript">
                MCTarget= document.querySelector('input[name="MCTarget"]');
                BeratTarget = document.querySelector('input[name="BeratTarget"]');
                MCSisa = document.querySelector('input[name="MCSisa"]');
                MCBaru = document.querySelector('input[name="MCBaru"]');
                BeratSisa = document.querySelector('input[name="BeratSisa"]');
                CalculateBahan = document.getElementById("CalculateBahan");
        
                CalculateBahan.addEventListener('click', function1(){

                    document.querySelector('input[name="BeratBaru"]').value = ((BeratTarget-BeratSisa)*(100-MCSisa))/(100-MCBaru);
                });
        
            </script>    
            --->
        </div>
        <form method="POST" action="{{url('/operator/baglog/recipe-submit', ['id' => $id,])}}" class="m-5">
            @csrf
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
                    <input type="text" name="NoKarungSKayu" class="form-control form-control-sm" id="colFormLabelSm">
                </div>
                <label for="SKayu" class="col-sm-2 col-form-label col-form-label-sm">Serbuk Kayu (kg):</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="SKayu" class="form-control form-control-sm" id="colFormLabelSm" disabled>
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
@endsection

