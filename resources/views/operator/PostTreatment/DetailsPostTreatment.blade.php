<div class="m-2">
    <h3 class="pb-2">Update Data</h3>
    <form action="{{ url('/operator/post-treatment/form-post-treatment-submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal  :</label>
            <div class="col-sm-5">
                <input type="date"   name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{$data['Tanggal']}}">
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
                <input type="text" name="Batch" class="form-control form-control-sm  @error('Batch') is-invalid @enderror" id="colFormLabelSm" value="{{$data['Batch']}}">
                @error('Batch')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        @if(Auth::user()->role == 'admin')
            <a href="{{url('/admin/post-treatment/delete', ['id'=>$data['id'],])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a>
        @endif
    </form>

</div>  

<div class="m-2">
    <h3>List Mylea</h3>
    <table class="table">
        <tr>
            <th>Mylea</th>
            <th>Jumlah</th>
        </tr>
        @foreach($data['Mylea'] as $Mylea)
        <tr>
            <td>{{$Mylea['KPMylea']}}</td>
            <td>{{$Mylea['Jumlah']}}</td>
            <td><a href="{{url('/operator/post-treatment/delete-mylea', ['id'=>$Mylea['id'],])}}" onclick="return confirm('Are you sure?')" class="btn btn-danger float-auto"><i class="bi-trash"></i></a></td>
        </tr>
        @endforeach
    </table>
    <div>
        <a class="btn btn-primary" onclick="AddMylea({{$data['id']}}, {{$data}})" data-dismiss="modal" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
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

<div class="m-2">
    <h3>List Proses</h3>
    <p>Total Reject : {{$data['PTData']->sum('Reject')}}</p>
    <table class="table">
        <tr>
            <th>Tanggal</th>
            <th>Proses</th>
            <th>Jumlah</th>
            <th>Reject</th>
            <th>Notes</th>
        </tr>
        <?php
            $id = 0;
        ?>
        @foreach($data['PTData'] as $PT)
        <tr>
            <td>{{$PT['Tanggal']}}</td>
            <td>{{$PT['Proses']}}</td>
            <td>{{$PT['Jumlah']}}</td>
            <td>{{$PT['Reject']}}</td>
            <td>{{$PT['Notes']}}</td>
            <td>                    
                <a class="btn btn-warning" onclick="EditProses({{$id}}, {{$data['PTData']}})" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data['id']}}">
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
                document.getElementById("Notes").value = data[id]['Notes'];
                $("#Proses").append(new Option(data[id]['Proses'], data[id]['Proses'], false, true));
            }
        </script>
            <?php
                $id++;
            ?>
        @endforeach
    </table>
</div>


    