@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Baglog</li>
        </ol>
    </nav>
</section>

<section class="list-group position-absolute m-5 top-50 start-50 translate-middle">
    <a href="{{ url('operator/baglog/pengayakan') }}" class="list-group-item list-group-item-action">Pengayakan</a><br>
    <a href="{{ url('operator/baglog/calcrecipe') }}" class="list-group-item list-group-item-action">Kalkulator Resep</a><br>
    <a href="{{ url('operator/baglog/mixing') }}" class="list-group-item list-group-item-action">Mixing</a><br>
    <a href="{{ url('operator/baglog/sterilisasi-option') }}" class="list-group-item list-group-item-action">Sterilisasi</a><br>
    <a href="{{ url('operator/baglog/pembibitan') }}" class="list-group-item list-group-item-action">Pembibitan</a><br>
    <a href="{{ url('operator/baglog/inkubasi-baglog') }}" class="list-group-item list-group-item-action">Monitoring Inkubasi Baglog</a><br>
    <a href="{{ url('operator/baglog/baglog-rnd') }}" class="list-group-item list-group-item-action">Baglog Eksternal</a><br>
</section>
@endsection