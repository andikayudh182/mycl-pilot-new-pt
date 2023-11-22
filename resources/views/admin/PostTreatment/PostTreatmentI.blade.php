@extends(auth()->user()->role === 'operator' ? 'layouts.operator' : 'layouts.admin')

@section('content')
<section class="m-5">
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
    <h3> Scouring Summary </h3>
    <h5> Total Belum Kerik : {{ $TotalBelumKerik }}</h5>
    <h5> Total Belum Rebus : {{ $TotalBelumRebus }}</h5>
    <h5> Total Rebus Original : {{ $TotalRebusOri }}</h5>
    <h5> Total Rebus Black : {{ $TotalRebusBlack }}</h5>
    <h5> Sisa Original : {{ $TotalSisaOri }}</h5>
    <h5> Sisa Black : {{ $TotalSisaBlack }}</h5>
    {{-- <h5> Total Sudah Dikerik : {{ $TotalSudahKerik }}</h5> --}}
    {{-- <h5> Total Reject Kerik : {{ $TotalRejectKerik  }}</h5>
    <h5> Total Reject Sebelum Kerik : {{$TotalRejectBeforeKerik  }} </h5>
    <h5> Total Sudah Rebus : {{ $TotalRebus }}</h5> --}}
    


    
    <form action="{{url('/post-treatment/I')}}" method="GET">
        <p>
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Filter by Tanggal Panen
          </a>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="row mb-3 ">
              <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAwal'])){{$_GET['TanggalAwal']}}@endif" required>
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
              <div class="col-sm-5">
                  <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['TanggalAkhir'])){{$_GET['TanggalAkhir']}}@endif" required>
              </div>
          </div>
          <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
          </div>
        </div>
      
        <div class="input-group mb-3" style="width:250px">
          <input type="text" name="SearchQuery" placeholder="Search Kode Mylea" value="{{ old('SearchQuery') }}" class="form-control">
          <div class="input-group-append">
            <input name="Submit" type="submit" value="Search" class="btn btn-outline-primary">
          </div>
        </div>
    </form>
    <table class="table">
        <tr class="sticky-header">
            <th>Kode Mylea</th>
            <th>Tanggal Panen</th>
            <th>Belum Dikerik</th>
            <th>Hasil Kerik</th>
            <th>Reject Kerik</th>
            <th style="border-right: 2px solid black">Reject Sebelum Kerik</th>
            <th>Rebus Original</th>
            <th>Rebus Black</th>
            <th>Total Rebus</th>
            <th style="border-right: 2px solid black" width="5%">Belum Rebus</th>
            <th style="border-right: 2px solid black" width="7%">Batch Post </br> Treatment</th>
            <th>Sisa Original</th>
            <th style="border-right: 2px solid black">Sisa Black</th>
            <th colspan="2" class="text-center">Aksi</th>
        </tr>

        @foreach($Trial as $data)
            <tr id = {{"Panen".$data['id']}}>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                        {{$data['KPMylea']}}
                    </button>
                    @include('admin.PostTreatment.Partials.MyleaPanenDetails')
                </td>
                <td>{{$data['TanggalPanen']}}</td>
                <td>{{$data['Jumlah']-$data['kerik']->sum('Jumlah')-$data['kerik']->sum('RejectBeforeKerik')-$data['kerik']->sum('RejectAfterKerik')}}</td>
                <td>{{$data['Kerik']->sum('Jumlah')}}</td>
                <td>{{$data['Kerik']->sum('RejectAfterKerik')}}</td>
                <td style="border-right: 2px solid black">{{$data['Kerik']->sum('RejectBeforeKerik')}}</td>
                <td>{{ $data['TotalRebusOri'] }}</td>
                <td>{{ $data['TotalRebusBlack'] }}</td>
                @php
                    $totalRebus = $data['TotalRebusOri'] + $data['TotalRebusBlack'];
                @endphp
                <td>{{ $totalRebus }}</td>
                <td style="border-right: 2px solid black">{{$data['Kerik']->sum('Jumlah') - $totalRebus }}</td>
                @if($data['PostTreatment']->sum('Jumlah') == 0)
                    <td style="border-right: 2px solid black">{{$data['PostTreatment']->sum('Jumlah')}}</td>
                @else
                    <td style="border-right: 2px solid black">
                        @foreach($data['PostTreatment'] as $item)
                            @if($item['Details'] && ($item['Details']['Status'] == null) )
                                <a href="#" data-bs-toggle="modal" data-bs-target="#DetailsPTModal{{$item['PT_ID']}}">
                                    {{ $item['Details']['Batch']}}
                                </a>
                                <br>
                            @elseif($item['Details'] && ($item['Details']['Status'] == 1))
                                <span>  {{ $item['Details']['Batch']}} (Archived)</span>
                            @endif
                           {{-- Modal Batch Post Treatment --}}
                            <div class="modal fade" id="DetailsPTModal{{$item['PT_ID']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @foreach($PTData as $pt)
                                    @if ($pt->id == $item['PT_ID'] )
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-text" style="color:black">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        {{$pt->Batch."/".$pt->Tanggal}}    
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="m-2">
                                                        <h3 class="pb-2">Update Data</h3>
                                                        <form action="{{ url('/operator/post-treatment/form-post-treatment-submit') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$pt['id']}}">
                                                            <div class="row mb-3 ">
                                                                <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal  :</label>
                                                                <div class="col-sm-5">
                                                                    <input type="date"   name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{$pt['Tanggal']}}">
                                                                    @error('Tanggal')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 ">
                                                                <label for="Batch" class="col-sm-2 col-form-label col-form-label-sm">Batch  :</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{$pt['Batch']}}">
                                                                    @error('Batch')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                                                            @if(Auth::user()->role == 'admin')
                                                                <a href="{{url('/admin/post-treatment/delete', ['id'=>$pt['id'],])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a>
                                                            @endif
                                                        </form>
                                                    
                                                    </div>
                                                    {{-- List Mylea --}}
                                                    <div class="m-2">
                                                        <h3>List Mylea</h3>
                                                        <table class="table">
                                                            <tr>
                                                                <th>Mylea</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                            @foreach($pt['Mylea'] as $Mylea)
                                                            <tr>
                                                                <td>{{$Mylea['KPMylea']}}</td>
                                                                <td>{{$Mylea['Jumlah']}}</td>
                                                                <td><a href="{{url('/operator/post-treatment/delete-mylea', ['id'=>$Mylea['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                        <div>
                                                            <a class="btn btn-primary" onclick="AddMylea({{$pt['id']}}, {{$pt}})" data-dismiss="modal" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Add Mylea
                                                            </a>
                                                            <script>
                                                                function AddMylea(id, data) {
                                                                    var ModalName = "#DetailsPTModal" +id;
                                                                    console.log(data.Tanggal);
                                                                    $(ModalName).modal('toggle');
                                                                    document.getElementById("PT_ID").value = data.id;
                                                                    document.getElementById("Tanggal").value = data.Tanggal;
                                                                    document.getElementById("Batch").value = data.Batch;
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                    {{-- End List Mylea  --}}

                                                    {{-- List Proses --}}
                                                    <div class="m-2">
                                                        <h3>List Proses</h3>
                                                        <p>Total Reject : {{$pt['PTData']->sum('Reject')}}</p>
                                                        <table class="table">
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th>Proses</th>
                                                                <th>Jumlah</th>
                                                                <th>Reject</th>
                                                            </tr>
                                                            <?php
                                                                $id = 0;
                                                            ?>
                                                            @foreach($pt['PTData'] as $PT)
                                                            <tr>
                                                                <td>{{$PT['Tanggal']}}</td>
                                                                <td>{{$PT['Proses']}}</td>
                                                                <td>{{$PT['Jumlah']}}</td>
                                                                <td>{{$PT['Reject']}}</td>
                                                                <td>                    
                                                                    <a class="btn btn-warning" onclick="EditProses({{$id}}, {{$pt['PTData']}})" data-bs-toggle="modal" data-bs-target="#exampleModal{{$pt['id']}}">
                                                                        <i class="bi-pencil-square"></i>
                                                                    </a>
                                                                </td>
                                                                <td><a href="{{url('/operator/post-treatment/delete', ['id'=>$PT['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
                                                            </tr>
                                                            <script>
                                                                function EditProses(id, data) {
                                                                    console.log(id);
                                                                    console.log(data[id]);
                                                                    document.getElementById("id").value = data[id]['id'];
                                                                    document.getElementById("Tanggal").value = data[id]['Tanggal'];
                                                                    document.getElementById("JamMulai").value = data[id]['JamMulai'];
                                                                    document.getElementById("JamSelesai").value = data[id]['JamSelesai'];
                                                                    document.getElementById("Jumlah").value = data[id]['Jumlah'];
                                                                    document.getElementById("Reject").value = data[id]['Reject'];
                                                                    $("#Proses").append(new Option(data[id]['Proses'], data[id]['Proses'], false, true));
                                                                }
                                                            </script>
                                                                <?php
                                                                    $id++;
                                                                ?>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    {{-- End List Proses --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                    @endif
                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- End Modal Batch Post Treatment --}}
                        @endforeach
                        
                    </td>
                @endif
                <td>{{ $data['SisaOri'] }}</td>
                <td style="border-right: 2px solid black">{{ $data['SisaBlack'] }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FormKerikModal{{$data['id']}}">
                        Form Kerik
                    </button>
                    @include('admin.PostTreatment.Partials.FormKerik')
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FormRebusModal{{$data['id']}}">
                        Form Rebus
                    </button>
                    @include('admin.PostTreatment.Partials.FormRebus')
                </td>
                @if($data['Jumlah']-$data['PostTreatment']->sum('Jumlah') < 0)
                <script>
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.color="red";
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.background="rgba(221,221,221,0.8)";
                </script>
                @elseif($data['kerik']->sum('Jumlah')-$data['PostTreatment']->sum('Jumlah') < 0)
                <script>
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.color="red";
                    document.getElementById("<?php echo "Panen".$data['id']?>").style.background="rgba(221,221,221,0.8)";
                </script>
                @endif
            </tr>
        
        @endforeach
        
    </table>
    {{-- <div class="d-flex justify-content-center">
        {!! $Data->links() !!}
    </div> --}}

</section>
<style>
/* style for freeze header */
.sticky-header {
        position: sticky;
        top: 0;
        background-color: #fff; 
        z-index: 1;
        border-color: 1px solid black;
}    
</style>

@endsection