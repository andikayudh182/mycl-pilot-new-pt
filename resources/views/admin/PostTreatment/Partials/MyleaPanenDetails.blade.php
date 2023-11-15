<div class="modal fade" id="exampleModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$data['KPMylea']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <th>Batch Post Treatment</th>
                    <th>Jumlah</th>
                    <th></th>
                </tr>
                
                @foreach($data['PostTreatment'] as $PT)
                <tr>
                    <td>@if(isset($PT['Details'])){{$PT['Details']['Batch']}}/{{$PT['Details']['Tanggal']}}@endif</td>
                    <td>{{$PT['Jumlah']}}</td>
                    <td><a href="{{url('/operator/post-treatment/delete-mylea', ['id'=>$PT['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
                </tr>
                @endforeach
            </table>
            <table class="table">
                <tr>
                    <th>Tanggal Kerik</th>
                    <th>Jumlah</th>
                    <th>Reject Sebelum Kerik</th>
                    <th>Reject Setelah Kerik</th>
                </tr>
                @foreach($data['kerik'] as $item)
                <tr>
                    <td>{{$item['Tanggal']}}</td>
                    <td>{{$item['Jumlah']}}</td>
                    <td>{{$item['RejectBeforeKerik']}}</td>
                    <td>{{$item['RejectAfterKerik']}}</td>
                    <td><a href="{{url('/admin/post-treatment/data-panen/delete-kerik', ['id'=>$item['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
                </tr>
                @endforeach
            </table>
            
            <table class="table">
                <tr>
                    <th>Tanggal Rebus</th>
                    <th>Jumlah Ori</th>
                    <th>Jumlah Black</th>
                    <th>Jumlah Total</th>
                </tr>
                @if(isset($data['Rebus']))
                  @foreach($data['Rebus'] as $item)
                  <tr>
                      <td>{{$item['Tanggal']}}</td>
                      <td>{{$item['JumlahOri']}}</td>
                      <td>{{$item['JumlahBlack']}}</td>
                      <td>{{$item['JumlahRebus']}}</td>
                      <td>
                        <!-- Button trigger modal -->
                        <a class="btn btn-warning" data-toggle="modal" data-target="#updateRebus{{ $item['id'] }}">
                            <i class="bi-pencil-square"></i>
                        </a>
                            @include('admin.PostTreatment.Partials.UpdateRebusDetails')
                      </td>
                      <td><a href="{{url('/admin/post-treatment/data-panen/delete-rebus', ['id'=>$item['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
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