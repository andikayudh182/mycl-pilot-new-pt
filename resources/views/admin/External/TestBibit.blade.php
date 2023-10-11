{{-- @foreach ( $data as $item)
    {{ $item['id'] }}
@endforeach --}}
@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


<table id="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Isolate Type</th>
            <th>F0 Prod Date</th>
            <th>F1 Trans Date</th>
            <th>F1 QC Date</th>
            <th>Total Sample</th>
            <th>Cont</th>
            <th>F2 Trans Date</th>
            <th>F2 QC Date</th>
            <th>Total Sample</th>
            <th>Cont</th>
            <th>F2 Ready Date</th>
            <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr class="text-center">
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['IsolateType'] }}</td>
                <td>{{ $item['F0Date'] }}</td>
                <td>{{ $item['F1Trans'] }}</td>
                <td>{{ $item['F1QCC'] }}</td>
                <td>{{ $item['TotalSampleF1'] }}</td>
                <td>{{ $item['ContaminationF1'] }}</td>
                <td>{{ $item['F2Trans'] }}</td>
                <td>{{ $item['F2QCC'] }}</td>
                <td>{{ $item['TotalSampleF2'] }}</td>
                <td>{{ $item['ContaminationF2'] }}</td>
                <td>{{ $item['F2ReadyDate'] }}</td>
                <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
</script>


@endsection
