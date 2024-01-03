@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="container">
        {{-- Alert Message --}}
        @if (session()->has('success'))
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @elseif(session()->has('error'))          
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        {{-- End Alert --}}

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('temperature-humidity-wstation.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="TemperatureHumidity" class="form-label">Upload File Temperature Humidity Working Station (Excel)</label>
                        <input class="form-control @error('TemperatureHumidity') is-invalid @enderror" type="file" id="TemperatureHumidity" name="TemperatureHumidity">
                        
                        @error('TemperatureHumidity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFilterDate"  role="button" aria-expanded="false" aria-controls="collapseFilterDate">Filter By Date</a>
        </div>

        {{-- Collapse Filter --}}
            @include('admin.Environtment.TemperatureHumidity.FilterDateWorkingStationRoom')
        {{-- End Collapse Filter --}}

        {{-- Table --}}
        <div class="mt-5">
            <table id="data-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Temperature</th>
                        <th>Humidity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $WorkingStationRoom as $data)
                        <tr>
                            @if ($data['Temperature'] <= 20 || $data['Temperature'] > 30 || $data['Humidity'] > 90)
                                <td style="color:red">{{ $data['Time'] }}</td>
                                <td style="color:red">{{ $data['Temperature'] }}</td>
                                <td style="color:red">{{ $data['Humidity'] }}</td>
                            @else
                                <td>{{ $data['Time'] }}</td>
                                <td>{{ $data['Temperature'] }}</td>
                                <td>{{ $data['Humidity'] }}</td>
                            @endif
                            
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Time</th>
                        <th>Temperature</th>
                        <th>Humidity</th>
                    </tr>
                </tfoot>
            </table>
            {{-- End Table --}}
        </div>

        {{-- Working Station Room Chart --}}
        @include('admin.Environtment.TemperatureHumidity.ChartPartials.WorkingStationRoomChart')
        {{-- End Working Station Room Chart --}}


    </div>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
</script>
@endsection