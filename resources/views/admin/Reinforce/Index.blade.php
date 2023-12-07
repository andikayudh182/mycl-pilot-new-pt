@extends(auth()->user()->role === 'operator' ? 'layouts.operator' : 'layouts.admin')

@section('content')

<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="{{ url('/operator/post-treatment') }}">Post Treatment</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">Reinforce</li>
        </ol>
    </nav>
</section>
<section class="m-5">
    {{-- Alert Message --}}
    <div class="alertDiv">
        @if(session()->has('Success'))
            <div class="alert alert-success" role="alert">
                {{session('Success')}}
            </div>
        @elseif(session()->has('Error'))
        <div class="alert alert-danger" role="alert">
            {{session('Error')}}
        </div>
        @endif
    </div>
      {{-- End Alert Message --}}
    <form action="{{route('ReinforceIndex')}}" method="GET">
        <p>
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
            Filter
          </a>
        </p>
        <div class="collapse" id="collapseFilter">
          <div class="card card-body">
            <div class="row mb-3 ">
              <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAwal') }}">
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAkhir') }}">
              </div>
          </div>
          <div class="row mb-3 ">
            {{-- <label for="Status" class="col-sm-2 col-form-label col-form-label-sm">Status :</label> --}}
            {{-- <div class="col-sm-5">
                <select type="date" name="Status" class="form-control form-control-sm " id="colFormLabelSm">
                  <option value="">Active</option>
                  <option value="1">Archived</option>
                </select>
            </div> --}}
        </div>
          <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
          </div>
        </div>
  
    </form>
    <div class="form-post-treatment">
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Form Input Data
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                @include('admin.Reinforce.Partials.FormInputReinforce')
            </div>
        </div>
        <script>
          $("#collapseExample").on('hidden.bs.collapse', function(){
            document.getElementById("PT_ID").value = null;
            document.getElementById("FormInputData").reset();
          });
         </script>
    </div>
    <div>
      <table class="table">
        <tr class="sticky-header">
            <th>Tanggal Pengerjaan</th>
            <th>Batch</th>
            <th>Warna</th>
            <th>Size</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th colspan="2" class="text-center">Aksi</th>
        </tr>
        @php
            $groupedData = $Data->groupBy(['TanggalPengerjaan']);
        @endphp
        @foreach($groupedData as $tanggal => $group)
            @php
                $rowspanCount = count($group);
            @endphp
            @foreach($group as $index => $data)
                <tr>

                    @if($index === 0)
                        <td rowspan="{{ $rowspanCount }}">{{ $data['TanggalPengerjaan'] }}</td>
                    @endif
                    <td>{{ $data['Batch'] }} </td>
                    <td>{{ $data['Warna'] }}</td>
                    <td>{{ $data['Size'] }}</td>
                    <td>{{ $data['Jenis'] }}</td>
                    <td>{{ $data['Jumlah'] }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $data['id'] }}">
                            Update
                        </button>     
                    </td>
                      @include('admin.Reinforce.Partials.FormUpdateReinforcePartials')
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $data['id'] }}">
                            Delete
                        </button>   
                    </td>
                      @include('admin.Reinforce.Partials.DeleteReinforceConfirmation')
                </tr>
            @endforeach
        @endforeach
    </table>
    </div>
    <div class="d-flex justify-content-center">
        {!! $Data->links() !!}
     </div>

</section>

@endsection