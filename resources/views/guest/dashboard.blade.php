@extends('layouts.guest')
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
    /* Gaya default untuk layar besar atau desktop */
.title {
    min-width: 235px;
}

/* Gaya untuk layar kecil atau perangkat seluler */
@media (max-width: 768px) {
    .title {
        min-width: 100%;
    }
}

/* Gaya untuk layar sangat kecil, seperti perangkat seluler di posisi landscape */
@media (max-width: 576px) {
    .title {
        font-size: 10px; /* Mengurangi ukuran font untuk layar yang lebih kecil */
    }

    /* Menyembunyikan tombol Target Settings pada layar kecil */
    .collapseExample {
        display: none;
    }
}


</style>

@section('content')
{{-- For 2023 --}}
<section class="body m-5 align-middle">
    <div class="" hidden>
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Target Settings
            </a>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateYearModal">
              Year Settings
            </a>
            {{-- Modal Year Settings --}}
            <div class="modal fade" id="updateYearModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Year Settings</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('MyleaDashboardProduction') }}" method="GET">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="Year" class="col-sm-4 col-form-label col-form-label-sm">Year</label>
                            <div class="col-md-8">
                                <select name="Year" id="Year" class="form-control form-control-sm col-sm-4 @error('Year') is-invalid @enderror" id="colFormLabelSm" required>
                                    <option value="2024" {{ $YearSetting == 2024 ? 'selected' : '' }}>2024</option>
                                    <option value="2023" {{ $YearSetting == 2023 ? 'selected' : '' }}>2023</option>
                                    <option value="2022" {{ $YearSetting == 2022 ? 'selected' : '' }}>2022</option>
                                </select>
                            </div>  
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-primary" value="1" name="FilterYear">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            {{-- End Modal Year Settings --}}
        </p>
        <div class="collapse" id="collapseExample" hidden>
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

    <div class="title">
        <h2>Mylea Dashboard {{ $YearSetting }}</h2>
    </div>

    <div class="table-responsive">
        <table class="title table table-hover table-bordered">
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
                <th class="title sticky-header-left bg-light">Substrate Bag Production</th>
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
                <td class="title sticky-header-left bg-light">Percentage mylea production to max capacity</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 1, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 2, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 3, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea, 4, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Mylea Production</th>
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
                <td class="title sticky-header-left bg-light">Harvest Rate</td>
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
        </table>
    </div>
</section>
{{-- For 2024 --}}
<section class="body m-5 align-middle">
    <div class="" hidden>
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Target Settings
            </a>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateYearModal">
              Year Settings
            </a>
            {{-- Modal Year Settings --}}
            <div class="modal fade" id="updateYearModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Year Settings</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('MyleaDashboardProduction') }}" method="GET">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="Year" class="col-sm-4 col-form-label col-form-label-sm">Year</label>
                            <div class="col-md-8">
                                <select name="Year" id="Year" class="form-control form-control-sm col-sm-4 @error('Year') is-invalid @enderror" id="colFormLabelSm" required>
                                    <option value="2024" {{ $YearSetting == 2024 ? 'selected' : '' }}>2024</option>
                                    <option value="2023" {{ $YearSetting == 2023 ? 'selected' : '' }}>2023</option>
                                    <option value="2022" {{ $YearSetting == 2022 ? 'selected' : '' }}>2022</option>
                                </select>
                            </div>  
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-primary" value="1" name="FilterYear">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            {{-- End Modal Year Settings --}}
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

    <div class="title">
        <h2>Mylea Dashboard {{ $YearSetting2024 }}</h2>
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
                <th class="title sticky-header-left bg-light">Substrate Bag Production</th>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '01')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '02')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '03')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '04')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '05')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '06')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '07')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '08')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '09')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '10')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '11')->sum('JumlahBaglog')}}</td>
                <td>{{$Baglog2024->where('TanggalPengerjaan', '12')->sum('JumlahBaglog')}}</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Percentage mylea production to max capacity</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea2024, 1, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea2024, 2, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea2024, 3, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
                <td colspan="3" class="text-center">{{QuarterMylea($Mylea2024, 4, $TargetMylea['MaxCapacity'])['Capacity']}}%</td>
            </tr>
            <tr>
                <th class="title sticky-header-left bg-light">Mylea Production</th>
                <td>{{$Mylea2024->where('TanggalProduksi', '01')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '02')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '03')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '04')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '05')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '06')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '07')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '08')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '09')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '10')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '11')->sum('Jumlah')}}</td>
                <td>{{$Mylea2024->where('TanggalProduksi', '12')->sum('Jumlah')}}</td>
            </tr>
            <tr>
                <td class="title sticky-header-left bg-light">Harvest Rate</td>
                <td>{{MyleaSuccessRate($Mylea2024, '01', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '02', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '03', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '04', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '05', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '06', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '07', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '08', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '09', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '10', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '11', $TodayDate2024)}} %</td>
                <td>{{MyleaSuccessRate($Mylea2024, '12', $TodayDate2024)}} %</td>
            </tr>
        </table>
    </div>
</section>
@endsection