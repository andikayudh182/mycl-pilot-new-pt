@extends('layouts.admin')

@section('content')
    <section class="list-group position-absolute m-5 top-50 start-50 translate-middle">
        <a href="{{ url('admin/environment/temperature/mylea') }}" class="list-group-item list-group-item-action">Mylea Room</a><br>
        <a href="{{ url('admin/environment/temperature/baglog') }}" class="list-group-item list-group-item-action">Baglog Room</a><br>
        <a href="{{ url('admin/environment/temperature/working-station') }}" class="list-group-item list-group-item-action">Working Station Room</a><br>
    </section>
@endsection