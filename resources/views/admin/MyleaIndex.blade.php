
@extends('layouts.admin')

@section('content')
{{-- <section class="m-5">
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
            <a href="{{ url('/admin/mylea/report') }}" class="btn btn-primary">Report Mylea</a>
        </li>
      </ul>
</section> --}}

<section class="body m-5 align-middle">
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
            <form action="{{ route('MyleaChart') }}" method="GET">
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
</section>

<section class="body m-5 align-middle">
    @include('admin.MyleaCharts')
</section>
<section class="body m-5 align-middle">
    <h3>Harvest Rate (Harvest Phase) %</h3>
    <table class="table md-5">
        <tr>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
        </tr>
        <tr>
            <td>{{$DataPoint3[1]}} %</td>
            <td>{{$DataPoint3[2]}} %</td>
            <td>{{$DataPoint3[3]}} %</td>
            <td>{{$DataPoint3[4]}} %</td>
            <td>{{$DataPoint3[5]}} %</td>
            <td>{{$DataPoint3[6]}} %</td>
            <td>{{$DataPoint3[7]}} %</td>
            <td>{{$DataPoint3[8]}} %</td>
            <td>{{$DataPoint3[9]}} %</td>
            <td>{{$DataPoint3[10]}} %</td>
            <td>{{$DataPoint3[11]}} %</td>
            <td>{{$DataPoint3[12]}} %</td>
        </tr>
    </table> 
   
</section>

<section class="body m-5 align-middle">
    <div id="chartContainer4" style="height: 370px; width: 100%;"></div> <br>
    <h3>Harvest Rate Direct Transfer (Harvest Phase) %</h3>
    <table class="table md-5">
        <tr>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
        </tr>
        <tr>
            <td>{{$DataPointDirect3[1]}} %</td>
            <td>{{$DataPointDirect3[2]}} %</td>
            <td>{{$DataPointDirect3[3]}} %</td>
            <td>{{$DataPointDirect3[4]}} %</td>
            <td>{{$DataPointDirect3[5]}} %</td>
            <td>{{$DataPointDirect3[6]}} %</td>
            <td>{{$DataPointDirect3[7]}} %</td>
            <td>{{$DataPointDirect3[8]}} %</td>
            <td>{{$DataPointDirect3[9]}} %</td>
            <td>{{$DataPointDirect3[10]}} %</td>
            <td>{{$DataPointDirect3[11]}} %</td>
            <td>{{$DataPointDirect3[12]}} %</td>
        </tr>
    </table>
</section>
{{-- <section class="mx-auto col-md-3 align-middle" style="height: 80vh;">
    <a href="{{ url('/admin/mylea/report') }}" class="list-group-item list-group-item-action">Report</a><br>
</section> --}}

@endsection