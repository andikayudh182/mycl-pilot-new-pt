@extends(auth()->user()->role === 'operator' ? 'layouts.operator' : 'layouts.admin')

@section('content')

<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="{{ url('/operator/post-treatment') }}">Post Treatment</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">Wet Process</li>
        </ol>
    </nav>
</section>
<section class="m-5">
    {{-- Alert Message --}}
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('message2'))
        <div class="alert alert-danger">
            {{ session()->get('message2') }}
        </div>
    @endif
    {{-- End Alert Message --}}

    <form action="{{url('/post-treatment/II')}}" method="GET">
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
    <div class="form-post-treatment">
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Form Input Data
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                @include('operator.PostTreatment.FormInputDataPartialPTII')
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
                <th>Batch</th>
                <th>Dyeing</th>
                <th>Ferro Sulfat</th>
                <th>Fat Liquor</th>
                <th>Fixing</th>
                <th>Moisturizing</th>
                <th>Drying</th>
                <th colspan= "2" class="text-center">Aksi</th>
            </tr>
           @foreach($Data as $data)
            <tr>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DetailsPTModal{{$data['id']}}">
                        {{$data['Batch']}} / {{$data['Tanggal']}}
                      </button>
                      {{-- Modal Batch Post Treatment --}}
                       <div class="modal fade" id="DetailsPTModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 800px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{$data['Batch']}} / {{$data['Tanggal']}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('operator.PostTreatment.DetailsPostTreatment')
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                <td>{{$data['PTData']->where('Proses','Dyeing')->sum('Jumlah')}}</td>
                <td>{{$data['PTData']->where('Proses','Ferro Sulfat')->sum('Jumlah')}}</td>
                <td>{{$data['PTData']->where('Proses','Fat Liquor')->sum('Jumlah')}}</td>
                <td>{{$data['PTData']->where('Proses','Fixing')->sum('Jumlah')}}</td>
                <td>{{$data['PTData']->where('Proses','Moisturizing')->sum('Jumlah')}}</td>
                <td>{{$data['PTData']->where('Proses','Drying')->sum('Jumlah')}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                        Update Post Treatment
                      </button>
                      <div class="modal fade" id="exampleModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{$data['Batch']}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @include('operator.PostTreatment.FormPostTreatmentII')
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td><a href="{{url('/operator/post-treatment/archive', ['id'=>$data['id'],])}}">Archived</a></td>
            </tr>
            <script>
              $("#exampleModal{{$data['id']}}").on('hide.bs.modal', function(){
                document.getElementById("id").value = '0';
                document.getElementById("FormPostTreatment").reset()
              });
             </script>
            @endforeach
        </table>
    </div>
    {{-- <div class="d-flex justify-content-center">
        {!! $Data->links() !!}
     </div> --}}

</section>

@endsection