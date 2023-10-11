@extends('layouts.admin')

@section('content')
<section class="body m-5 align-middle">
    @include('admin.BaglogCharts')
</section>

<section class="body m-5 align-middle">
    <h3>Kontaminasi</h3>
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

<section class="mx-auto col-md-3 align-middle" style="height: 80vh;">
    <a href="{{ url('/admin/baglog/data-recipe') }}" class="list-group-item list-group-item-action">Data Recipe</a><br>
    <a href="{{ url('operator/baglog/inkubasi-baglog') }}" class="list-group-item list-group-item-action">Monitoring Inkubasi (Operator)</a><br>
    <a href="{{ url('/admin/baglog/report') }}" class="list-group-item list-group-item-action">Report</a><br>
</section>
@endsection