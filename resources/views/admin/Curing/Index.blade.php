@extends(auth()->user()->role === 'operator' ? 'layouts.operator' : 'layouts.admin')

@section('content')

<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Curing</li>
        </ol>
    </nav>
</section>
<section class="m-5">
    {{-- Alert Message --}}
    <div class="alertDiv">
      @if(session()->has('message'))
          <div class="alert alert-success" role="alert">
              {{session('message')}}
          </div>
      @elseif(session()->has('Error'))
      <div class="alert alert-danger" role="alert">
          {{session('Error')}}
      </div>
      @endif
  </div>

  <h3>Curing Summary </h3>
  <h5> Grade A : {{ $totalGradeA }}</h5>
  <h5> Grade B : {{ $totalGradeB }}</h5>
  <h5> Grade C : {{ $totalGradeC }}</h5>
  <h5> Grade D : {{ $totalGradeD }}</h5>

    {{-- End Alert Message --}}

    <form action="{{url('/curing/')}}" method="GET">
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
                  <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAwal'])){{$_GET['TanggalAwal']}}@endif">
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAkhir'])){{$_GET['TanggalAkhir']}}@endif">
              </div>
          </div>
          <div class="row mb-3 ">
            <label for="Status" class="col-sm-2 col-form-label col-form-label-sm">Status :</label>
            <div class="col-sm-5">
                <select type="date" name="Status" class="form-control form-control-sm " id="colFormLabelSm">
                  <option value="">Active</option>
                  <option value="1">Archived</option>
                </select>
            </div>
        </div>
          <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
          </div>
        </div>
  
    </form>
 
    <div>
        <table class="table">
            <tr class="sticky-header">
                <th>Batch</th>
                <th >Schedule Finish Curing</th>
                <th>Actual Finish Curing</th>
                <th>Tanggal Pengerjaan</th>
                <th>Warna</th>
                <th>Grade A (26x46)</th>
                <th>Grade B (20x40) </th>
                <th>Grade C (15x40)</th>
                <th>Grade D</th>
                <th colspan= "2" class="text-center">Aksi</th>
            </tr>
           @foreach($Data as $data)
         <tr>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DetailsPTModal{{$data['id']}}">
                        {{$data['Batch']}} / {{$data['TanggalPostTreatment']}}
                      </button>
                      {{-- Modal Batch Post Treatment --}}
                       <div class="modal fade" id="DetailsPTModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{$data['Batch']}} / {{$data['TanggalPostTreatment']}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('admin.Curing.Partials.DetailPostTreatment')
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td>{{ $data['ScheduleFinishCuring'] }}</td>
                <td>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalActual{{$data['id']}}" style="text-decoration:none;">
                    @if(isset($data['Curing'][0]['ActualFinishCuring']))
                      {{ $data['Curing'][0]['ActualFinishCuring'] }}
                    @else
                        -
                    @endif
                  </a>
                  @include('admin.Curing.Partials.InputActualFinishCuring')
                </td>
                <td>
                  @if(isset($data['Curing'][0]['TanggalPengerjaan']))
                  {{ $data['Curing'][0]['TanggalPengerjaan'] }}
                  @else
                      -
                  @endif
                </td>
                <td>
                  @if(isset($data['Curing'][0]['Warna']))
                  {{ $data['Curing'][0]['Warna'] }}
                  @else
                      -
                  @endif
                </td>
                <td>
                  @if(isset($data['Curing'][0]['SizeSatu']))
                    {{ $data['Curing'][0]['SizeSatu'] }} 
                  @else
                      0 
                  @endif
                </td>
                <td>
                  @if(isset($data['Curing'][0]['SizeDua']))
                   {{ $data['Curing'][0]['SizeDua'] }}
                  @else
                      0
                  @endif
                </td>
                <td>
                  @if(isset($data['Curing'][0]['SizeTiga']))
                  {{ $data['Curing'][0]['SizeTiga'] }}
                  @else
                      0
                  @endif
                </td>
                <td>
                  @if(isset($data['Curing'][0]['SizeEmpat']))
                  {{ $data['Curing'][0]['SizeEmpat'] }}
                  @else
                      0
                  @endif
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateSizeModal{{ $data['id'] }}">
                    Form Size
                  </button>
                
                </td>
                   @include('admin.Curing.Partials.FormSize')
            </tr>
            @endforeach
        </table>
    </div> 
    <div class="d-flex justify-content-center">
        {!! $Data->links() !!}
     </div> 

</section>  

@endsection