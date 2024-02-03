@extends('layouts.guest')

@section('content')
<section class="body m-5 align-middle">
    @include('guest.Partials.MyleaCharts')
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
    <div id="chartContainer2024" style="height: 370px; width: 100%;"></div> <br>
    <h3>Harvest Rate  (Harvest Phase) %</h3>
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
            <td>{{$DataPoint20243[1]}} %</td>
            <td>{{$DataPoint20243[2]}} %</td>
            <td>{{$DataPoint20243[3]}} %</td>
            <td>{{$DataPoint20243[4]}} %</td>
            <td>{{$DataPoint20243[5]}} %</td>
            <td>{{$DataPoint20243[6]}} %</td>
            <td>{{$DataPoint20243[7]}} %</td>
            <td>{{$DataPoint20243[8]}} %</td>
            <td>{{$DataPoint20243[9]}} %</td>
            <td>{{$DataPoint20243[10]}} %</td>
            <td>{{$DataPoint20243[11]}} %</td>
            <td>{{$DataPoint20243[12]}} %</td>
        </tr>
    </table>
</section>
@endsection