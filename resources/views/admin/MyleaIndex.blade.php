
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