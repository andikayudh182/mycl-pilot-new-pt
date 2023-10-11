<div class="modal fade" id="BaglogModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Baglog {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
              <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Add Baglog
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="{{url('/admin/mylea/report/baglog-submit')}}" method="POST">
                      @csrf
                      <div class="row mb-3 ">
                          <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                          <div class="col-sm-5">
                              <input type="text"  name="KodeProduksi" class="form-control form-control-sm  @error('KodeProduksi') is-invalid @enderror" id="colFormLabelSm" value="{{$data['KodeProduksi']}}">
                              @error('KodeProduksi')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>
                      <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Kode Produksi Baglog</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="KodeBaglog" class="form-select" id="KodeBaglog">
                                    @if(isset($DataBaglog[0]))
                                      @foreach ($DataBaglog as $item)
                                          <option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>
                                      @endforeach
                                    @endif
                                    @foreach ($BaglogRnD as $item)
                                      <option value="{{$item['KodeProduksi']}}">{{$item['KodeProduksi']}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="Jumlah" class="form-control" /></td>
                            <td>
                                <select name="KondisiBaglog" class="form-control form-control-sm" id="colFormLabelSm" >
                                    <option value="Non Crushing">Non Crushing</option>
                                    <option value="Crushing-Putih Semua">Crushing-Putih Semua</option>
                                    <option value="Crushing-Setengah Tumbuh">Crushing-Setengah Tumbuh</option>
                                </select>
                            </td>
                        </tr>
                        </table>      
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                    </form>
                </div>
              </div>
            </div>
            <table class="table">
                <tr>
                    <th>Kode Baglog</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th></th>
                </tr>
                @if(isset($data['DataBaglog']))
                @foreach($data['DataBaglog'] as $DataBaglog)
                    <tr>
                        <td>{{$DataBaglog['KPBaglog']}}</td>
                        <td>{{$DataBaglog['JumlahBaglog']}}</td>
                        <td>{{$DataBaglog['KondisiBaglog']}}</td>
                        <td><a href="{{url('/admin/mylea/report/baglog-delete', ['id'=>$DataBaglog['id'],])}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                @endif
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>