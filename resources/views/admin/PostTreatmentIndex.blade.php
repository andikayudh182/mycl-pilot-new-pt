@extends('layouts.admin')

@section('content')
<section class="list-group position-absolute m-5 top-50 start-50 translate-middle">
    <a href="{{ url('admin/post-treatment/data-panen') }}" class="list-group-item list-group-item-action">Mylea - Data Panen</a><br>
    <a href="{{ url('operator/post-treatment/monitoring') }}" class="list-group-item list-group-item-action">Monitoring Post Treatment [Operator]</a><br>
    <a href="{{ url('admin/post-treatment/report') }}" class="list-group-item list-group-item-action">Report</a><br>
</section>
@endsection