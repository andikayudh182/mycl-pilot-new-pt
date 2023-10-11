@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Treatment</li>
        </ol>
    </nav>
</section>

<section class="list-group position-absolute m-5 top-50 start-50 translate-middle">
    <a href="{{ url('operator/post-treatment/data-panen') }}" class="list-group-item list-group-item-action">Mylea Data Panen</a><br>
    <a href="{{ url('operator/post-treatment/monitoring') }}" class="list-group-item list-group-item-action"> Monitoring Post Treatment</a><br>
</section>
@endsection