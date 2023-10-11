@extends('layouts.operator')

@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Baglog Eksternal</li>
            </ol>
        </nav>
    </div>
    <section class="m-5">
          <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Input Form
            </a>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <h3 class="m-3">Form Input Baglog Eksternal</h3>
                <form method="POST" action="{{url('/operator/baglog/baglog-rnd-submit')}}" class="m-5">
                    @csrf
                    <div class="row mb-3 ">
                        <label for="TanggalBaglog" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Baglog :</label>
                        <div class="col-sm-5">
                            <input type="date"  name="TanggalBaglog" class="form-control form-control-sm  @error('TanggalBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                            @error('TanggalBaglog')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="Departemen" class="col-sm-2 col-form-label col-form-label-sm">Departemen :</label>
                        <div class="col-sm-5">
                            <input type="text"  name="Departemen" class="form-control form-control-sm  @error('Departemen') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                            @error('Departemen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="JenisResep" class="col-sm-2 col-form-label col-form-label-sm">Jenis Resep :</label>
                        <div class="col-sm-5">
                            <input type="text"  name="JenisResep" class="form-control form-control-sm  @error('JenisResep') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalPengerjaaan') }}">
                            @error('JenisResep')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
                        <div class="col-sm-5">
                            <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JumlahBaglog') }}">
                            @error('JumlahBaglog')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 ">
                        <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                        <div class="col-sm-5">
                            <input type="text"  name="Keterangan" class="form-control form-control-sm  @error('Keterangan') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Keterangan') }}">
                            @error('Keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                </form>
            </div>
          </div>
            @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
            @endif
          <table class="table">
            <tr class="sticky-header">
                <th>Kode Produksi</th>
                <th>Pemakaian Mylea</th>
                <th>Departemen</th>
                <th>Jenis Recipe</th>
                <th>Jumlah</th>
                <th>In Stock</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th colspan="2" class="text-center">Aksi</th>
            </tr>
            @foreach ($Baglog as $data)
            <tr>
                <td>{{$data['KodeProduksi']}}</td>
                <td>
                    @foreach($data['Pemakaian'] as $item)
                    <a href="{{url('/admin/mylea/report?TanggalAwal=&TanggalAkhir=&SearchQuery='.$item['KPMylea'].'&Submit=Search')}}">{{$item['KPMylea']}} ({{$item['JumlahBaglog']}}) </a></br>
                    @endforeach
                </td>
                <td>{{$data['Departemen']}}</td>
                <td>{{$data['JenisResep']}}</td>
                <td>{{$data['Jumlah']}}</td>
                <td>{{$data['InStock']}}</td>
                <td>{{$data['Keterangan']}}</td>
                @if($data['StatusArchive'] == NULL OR $data['StatusArchive']=='0')
                    <td>Active</td>
                @else
                    <td>Archived</td>
                @endif
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
                        Edit
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Data Baglog {{$data['KodeProduksi']}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{url('/operator/baglog/baglog-rnd-update')}}" class="m-5">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <div class="row mb-3 ">
                                        <label for="TanggalBaglog" class="col-sm-3 col-form-label col-form-label-sm">Tanggal Baglog :</label>
                                        <div class="col-sm-5">
                                            <input type="date"  name="TanggalBaglog" class="form-control form-control-sm  @error('TanggalBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{$data['TanggalBaglog']}}">
                                            @error('TanggalBaglog')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <label for="JenisResep" class="col-sm-3 col-form-label col-form-label-sm">Jenis Resep :</label>
                                        <div class="col-sm-5">
                                            <input type="text"  name="JenisResep" class="form-control form-control-sm  @error('JenisResep') is-invalid @enderror" id="colFormLabelSm" value="{{$data['JenisResep']}}">
                                            @error('JenisResep')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <label for="JumlahBaglog" class="col-sm-3 col-form-label col-form-label-sm">Jumlah Baglog :</label>
                                        <div class="col-sm-5">
                                            <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="{{$data['Jumlah']}}">
                                            @error('JumlahBaglog')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <label for="Keterangan" class="col-sm-3 col-form-label col-form-label-sm">Keterangan :</label>
                                        <div class="col-sm-5">
                                            <input type="text"  name="Keterangan" class="form-control form-control-sm  @error('Keterangan') is-invalid @enderror" id="colFormLabelSm" value="{{$data['Keterangan']}}">
                                            @error('Keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 ">
                                        <label for="Status" class="col-sm-3 col-form-label col-form-label-sm">Status :</label>
                                        <div class="col-sm-5">
                                            <select name="StatusArchive" class="form-control form-control-sm" id="colFormLabelSm" >
                                                <option value="{{$data['StatusArchive']}}">
                                                    @if($data['StatusArchive'] == NULL OR $data['StatusArchive']=='0')
                                                        Active
                                                    @else
                                                        Archived
                                                    @endif
                                                </option>
                                                <option value="0">Active</option>
                                                <option value="1">Archived</option>
                                        </select>
                                        </div>
                                    </div>
                                    <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td>
                    <a href="{{url('/operator/baglog/baglog-rnd-delete', ['id'=>$data['id'],])}}" class="btn btn-primary float-auto">Delete</a>
                </td>
            </tr> 
            @endforeach
          </table>
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