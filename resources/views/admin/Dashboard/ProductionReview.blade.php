@extends('layouts.admin')
@include('admin.Dashboard.Logic')
<style>
    th {
        min-width:100px;
        max-width:100px;
    }
    .title{
        min-width:235px;
        /* max-width:220px; */
    }
    .sticky-header-left{
        position: sticky;
        left: 0;
        z-index: 1;
    }

</style>
@section('content')
<section class="body m-5 align-middle">
    <div class="m-4">
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Target Settings
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form method="POST" action="{{ url('/dashboard-production-target-submit')}}">
                    @csrf
                    <h3>Baglog</h3>
                    <div class="row mb-3 ">
                        <label for="BaglogQ1" class="col-sm-1 col-form-label col-form-label-sm">Q1 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="BaglogQ1" value="{{$TargetBaglog['Q1']}}" class="form-control form-control-sm  @error('Q1') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="BaglogQ2" class="col-sm-1 col-form-label col-form-label-sm">Q2 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="BaglogQ2" value="{{$TargetBaglog['Q2']}}" class="form-control form-control-sm  @error('Q2') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="BaglogQ3" class="col-sm-1 col-form-label col-form-label-sm">Q3 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="BaglogQ3" value="{{$TargetBaglog['Q3']}}" class="form-control form-control-sm  @error('Q3') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="BaglogQ4" class="col-sm-1 col-form-label col-form-label-sm">Q4 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="BaglogQ4" value="{{$TargetBaglog['Q4']}}" class="form-control form-control-sm  @error('Q4') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="BaglogMaxCapacity" class="col-sm-1 col-form-label col-form-label-sm">Max Capacity :</label>
                        <div class="col-sm-2">
                            <input type="number"  name="BaglogMaxCapacity" value="{{$TargetBaglog['MaxCapacity']}}" class="form-control form-control-sm  @error('Q4') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <h3>Mylea</h3>
                    <div class="row mb-3 ">
                        <label for="MyleaQ1" class="col-sm-1 col-form-label col-form-label-sm">Q1 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="MyleaQ1" value="{{$TargetMylea['Q1']}}" class="form-control form-control-sm  @error('Q1') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="MyleaQ2" class="col-sm-1 col-form-label col-form-label-sm">Q2 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="MyleaQ2" value="{{$TargetMylea['Q2']}}" class="form-control form-control-sm  @error('Q2') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="MyleaQ3" class="col-sm-1 col-form-label col-form-label-sm">Q3 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="MyleaQ3" value="{{$TargetMylea['Q3']}}" class="form-control form-control-sm  @error('Q3') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="MyleaQ4" class="col-sm-1 col-form-label col-form-label-sm">Q4 :</label>
                        <div class="col-sm-1">
                            <input type="number"  name="MyleaQ4" value="{{$TargetMylea['Q4']}}" class="form-control form-control-sm  @error('Q4') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <label for="MyleaMaxCapacity" class="col-sm-1 col-form-label col-form-label-sm">Max Capacity :</label>
                        <div class="col-sm-2">
                            <input type="number"  name="MyleaMaxCapacity" value="{{$TargetMylea['MaxCapacity']}}" class="form-control form-control-sm  @error('Q4') is-invalid @enderror" id="colFormLabelSm">
                            @error('Q4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th rowspan="2" class="table-dark border-white sticky-header-left"></th>
                <th colspan="3" class="text-center table-dark border-white">Q1</th>
                <th colspan="3" class="text-center table-dark border-white">Q2</th>
                <th colspan="3" class="text-center table-dark border-white">Q3</th>
                <th colspan="3" class="text-center table-dark border-white">Q4</th>
            </tr>
            <tr>
                <th class="table-dark border-white">Jan</th>
                <th class="table-dark border-white">Feb</th>
                <th class="table-dark border-white">Mar</th>
                <th class="table-dark border-white">Apr</th>
                <th class="table-dark border-white">May</th>
                <th class="table-dark border-white">Jun</th>
                <th class="table-dark border-white">Jul</th>
                <th class="table-dark border-white">Aug</th>
                <th class="table-dark border-white">Sep</th>
                <th class="table-dark border-white">Oct</th>
                <th class="table-dark border-white">Nov</th>
                <th class="table-dark border-white">Dec</th>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Percentage baglog production to max capacity</td>
                <td colspan="3" class="text-center">{{QuarterBaglog($Baglog, 1, $TargetBaglog['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterBaglog($Baglog, 2, $TargetBaglog['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterBaglog($Baglog, 3, $TargetBaglog['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterBaglog($Baglog, 4, $TargetBaglog['MaxCapacity'])['Capacity']}}%</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Baglog Output</th>
                <td>{{$Baglog->where('TanggalPengerjaan', '01')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '02')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '03')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '04')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '05')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '06')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '07')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '08')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '09')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '10')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '11')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog->where('TanggalPengerjaan', '12')->sum('JumlahBaglog')}}</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Baglog Success Rate</th>
                <td>{{BaglogContamination($Baglog, '01')}} %</td>
                <td>{{BaglogContamination($Baglog, '02')}} %</td>
                <td>{{BaglogContamination($Baglog, '03')}} %</td>
                <td>{{BaglogContamination($Baglog, '04')}} %</td>
                <td>{{BaglogContamination($Baglog, '05')}} %</td>
                <td>{{BaglogContamination($Baglog, '06')}} %</td>
                <td>{{BaglogContamination($Baglog, '07')}} %</td>
                <td>{{BaglogContamination($Baglog, '08')}} %</td>
                <td>{{BaglogContamination($Baglog, '09')}} %</td>
                <td>{{BaglogContamination($Baglog, '10')}} %</td>
                <td>{{BaglogContamination($Baglog, '11')}} %</td>
                <td>{{BaglogContamination($Baglog, '12')}} %</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Target Success Rate Baglog</td>
                <td colspan="3" class="text-center">{{$TargetBaglog['Q1']}}%</td>
                <td colspan="3" class="text-center">{{$TargetBaglog['Q2']}}%</td>
                <td colspan="3" class="text-center">{{$TargetBaglog['Q3']}}%</td>
                <td colspan="3" class="text-center">{{$TargetBaglog['Q4']}}%</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Actual Success Rate Baglog</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterBaglog($Baglog, 1, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q1'])['Style']}}">{{SuccessRate(QuarterBaglog($Baglog, 1, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q1'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterBaglog($Baglog, 2, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q2'])['Style']}}">{{SuccessRate(QuarterBaglog($Baglog, 2, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q2'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterBaglog($Baglog, 3, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q3'])['Style']}}">{{SuccessRate(QuarterBaglog($Baglog, 3, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q3'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterBaglog($Baglog, 4, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q4'])['Style']}}">{{SuccessRate(QuarterBaglog($Baglog, 4, $TargetBaglog['MaxCapacity']), $TargetBaglog['Q4'])['Text']}}</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Percentage mylea production to max capacity</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 1, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 2, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 3, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 4, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Mylea Output</th>
                <td>{{$Mylea->where('TanggalProduksi', '01')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '02')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '03')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '04')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '05')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '06')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '07')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '08')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '09')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '10')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '11')->sum('Jumlah')}}</td>
                <td>{{$Mylea->where('TanggalProduksi', '12')->sum('Jumlah')}}</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Mylea Success Rate</th>
                <td>{{MyleaSuccessRate($Mylea, '01', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '02', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '03', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '04', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '05', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '06', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '07', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '08', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '09', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '10', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '11', $TodayDate)}} %</td>
                <td>{{MyleaSuccessRate($Mylea, '12', $TodayDate)}} %</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Target Success Rate Mylea</td>
                <td colspan="3" class="text-center">{{$TargetMylea['Q1']}}%</td>
                <td colspan="3" class="text-center">{{$TargetMylea['Q2']}}%</td>
                <td colspan="3" class="text-center">{{$TargetMylea['Q3']}}%</td>
                <td colspan="3" class="text-center">{{$TargetMylea['Q4']}}%</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Actual Success Rate Mylea</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterMylea($Mylea, 1, $TargetMylea['MaxCapacity']), $TargetMylea['Q1'])['Style']}}">{{SuccessRate(QuarterMylea($Mylea, 1, $TargetMylea['MaxCapacity']), $TargetMylea['Q1'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterMylea($Mylea, 2, $TargetMylea['MaxCapacity']), $TargetMylea['Q2'])['Style']}}">{{SuccessRate(QuarterMylea($Mylea, 2, $TargetMylea['MaxCapacity']), $TargetMylea['Q2'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterMylea($Mylea, 3, $TargetMylea['MaxCapacity']), $TargetMylea['Q3'])['Style']}}">{{SuccessRate(QuarterMylea($Mylea, 3, $TargetMylea['MaxCapacity']), $TargetMylea['Q3'])['Text']}}</td>
                <td colspan="3" class="text-center {{SuccessRate(QuarterMylea($Mylea, 4, $TargetMylea['MaxCapacity']), $TargetMylea['Q4'])['Style']}}">{{SuccessRate(QuarterMylea($Mylea, 4, $TargetMylea['MaxCapacity']), $TargetMylea['Q4'])['Text']}}</td>
            </tr>
        </table>
    </div>
</section>

@endsection