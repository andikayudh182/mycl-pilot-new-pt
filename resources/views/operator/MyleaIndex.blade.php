@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Mylea</li>
        </ol>
    </nav>
</section>

<section class="list-group position-absolute m-5 top-50 start-50 translate-middle">
    <a href="{{ url('operator/mylea/form-produksi') }}" class="list-group-item list-group-item-action">Form Produksi</a><br>
    <a href="{{ url('operator/mylea/monitoring') }}" class="list-group-item list-group-item-action">Monitoring Mylea</a><br>
    <a href="{{ url('operator/mylea/form-elus') }}" class="list-group-item list-group-item-action">Form Elus</a><br>
</section>
@endsection