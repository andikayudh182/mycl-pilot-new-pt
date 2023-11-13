<div class="modal fade" id="updateModal{{ $data['id'] }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Reinforce</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('ReinforceUpdate')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$data['id']}}">
                <div class="mb-3">
                    <label for="TanggalPengerjaan" class="form-label">Tanggal Pengerjaan</label>
                    <input type="date" class="form-control" id="TanggalPengerjaan" name="TanggalPengerjaan" value="{{$data['TanggalPengerjaan']}}" required>
                </div>
                <div class="mb-3">
                    <label for="Batch" class="form-label">Batch/Warna/Size/Available</label>
                    <select name="CuringID" class="form-control select2-single" id="CuringID" style="width:100%; background-color: #f8fafc;" onchange="SetMaxUpdate()">
                        @foreach ($FormData as $item)
                        <option value="{{$item['id'].",".$item['Size']}}" {{ $item['id'].",".$item['Size'] == $data['CuringID'].",".$data['Size'] ? 'selected' : '' }}>
                            {{ $item['Batch'] }} - {{ $item['Warna'] }} - {{ $item['Size'] }} (Available: {{ $item['Jumlah'] }}) {{ $item['id'].",".$item['Size'] == $data['CuringID'].",".$data['Size'] ? '+'.$data['Jumlah'] : '' }}
                            @php 
                                if($item['id'].",".$item['Size'] == $data['CuringID'].",".$data['Size']){
                                    $item['Jumlah'] = $item['Jumlah'] + $data['Jumlah'];
                                }
                            @endphp
                        </option>
                    @endforeach 
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Jenis" class="form-label">Jenis</label>
                    <select name="Jenis" id="Jenis" class="form-control" style="width:100%; background-color: #f8fafc">
                        <option value="" {{ empty($data['Jenis']) ? 'selected' : '' }} disabled>Pilih Jenis</option>
                        <option value="Euca Sateen" {{ "Euca Sateen" == $data['Jenis'] ? 'selected' : '' }} >Euca Sateen</option>
                        <option value="Lyco Linen" {{ "Lyco Linen" == $data['Jenis'] ? 'selected' : '' }} >Lyco Linen</option>
                        <option value="Other" {{ "Other" == $data['Jenis'] ? 'selected' : '' }} >Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="Jumlah" name="Jumlah" value="{{$data['Jumlah']}}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>  
            </div>
        </div>
    </div>
</div>

<script>
    var dat = <?php echo json_encode($FormData)?>;

    $( document ).ready(function() {
        SetMaxUpdate();
    });

    function SetMaxUpdate() {
        name = "CuringID";
        var e = document.getElementById("CuringID");
        var value = e.options[e.selectedIndex].value;
        console.log(dat);
        const array = value.split(',');

        let obj = dat.find(o => o.id === parseInt(array[0]) && o.Size === array[1]);

        var max = obj.Jumlah;
        console.log(max);
        if(value == '<?php echo $data['CuringID'].",".$data['Size']?>'){
            max = max + <?php echo $data['Jumlah']?>
        }
        console.log(max);
        inputId = "#Jumlah";

        $(inputId).attr({
            "max" : max,
            "min" : 1
        });
    }
</script>

