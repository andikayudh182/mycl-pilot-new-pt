@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- Alert Message --}}
        @if (session()->has('success'))
            <div class="d-flex justify-content-center align-items-center">
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>          
        @endif
        {{-- End Alert --}}

        
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('temperature-humidity.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="TemperatureHumidity" class="form-label">Upload File Temperature Humidity (Excel)</label>
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
    </div>
@endsection
