<div class="modal fade" id="PanenModal{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Panen {{$data['KodeProduksi']}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- @if(isset($Panen['Baglog'][0])) --}}
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Tanggal Panen</th>
                    <th>Kode Produksi Baglog</th>
                    <th>Jumlah</th>
                    <th>No Bibit</th>
                    <th>Kondisi Baglog</th>
                    <th>Jenis Panen</th>
                    <th>Aksi</th>
                </tr>
                @foreach($data['Panen'] as $Panen)
                    @foreach($Panen['Baglog'] as $BaglogPanen)
                    <tr>
                        <td>{{$Panen['TanggalPanen']}}</td>
                        <td>{{$BaglogPanen['KPBaglog']}}</td>
                        <td>{{$BaglogPanen['Jumlah']}}</td>
                        <td>{{$BaglogPanen['NoBibit']}}</td>
                        <td>{{$BaglogPanen['KondisiBaglog']}}</td>
                        <td>{{$BaglogPanen['Keterangan']}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-edit" data-panen-id="{{ $Panen }}"
                            data-form-id="editPanenForm_{{ $data['id'] }}">
                                Edit
                            </button>
                        </td>
                        
                    </tr>
                    @endforeach
                @endforeach
            </table>
                {{-- @endif --}}

    
         <form method="POST" action="{{url('/admin/mylea/report/panen-update')}}" class="m-5" id="editPanenForm_{{$data['id']}}" style="display:none;" >
                @csrf
                <input type="hidden" name="id" value="">
                <input type="hidden" name="KPMylea" value="{{$data['KodeProduksi']}}">
                <div class="row mb-3">
                    <label for="TanggalPanen" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Panen :</label>
                    <div class="col-sm-5">
                        <input type="date" name="TanggalPanen" class="form-control form-control-sm @error('TanggalPanen') is-invalid @enderror" id="TanggalPanen" value="">
                        @error('TanggalPanen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="JamMulai" class="col-sm-2 col-form-label col-form-label-sm" >Jam Mulai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamMulai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="">
                        @error('JamMulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="JamSelesai" class="col-sm-2 col-form-label col-form-label-sm">Jam Selesai :</label>
                    <div class="col-sm-5">
                        <input type="time"  name="JamSelesai" class="form-control form-control-sm  @error('') is-invalid @enderror" id="colFormLabelSm" value="">
                        @error('JamSelesai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- <input type="text" id="testID" value=""> --}}
                <div class="row mb-3 ">
                    <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
                    <div class="col-sm-5">
                        <input type="number"  name="JumlahBaglog" class="form-control form-control-sm  @error('JumlahBaglog') is-invalid @enderror" id="colFormLabelSm" value="">
                        @error('JumlahBaglog')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                <a href="{{ url('/admin/mylea/report/panen-delete', ['id' => 'REPLACE_ME']) }}" class="btn btn-primary float-auto delete-panen-link">Delete</a>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-close-form" data-bs-dismiss="modal">Close</button>
        </div> 
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
        
        $('.btn-edit').click(function() {
            var panenId = $(this).data('panen-id');
            var formId = $(this).data('form-id');
            $('#' + formId).show();

            // Populate the edit form fields with the corresponding data
            $('#' + formId + ' input[name="id"]').val(panenId.id);
            $('#' + formId + ' input[name="TanggalPanen"]').val(panenId.TanggalPanen);
            $('#' + formId + ' input[name="JamMulai"]').val(panenId.JamMulai);
            $('#' + formId + ' input[name="JamSelesai"]').val(panenId.JamSelesai);
            $('#' + formId + ' input[name="JumlahBaglog"]').val(panenId.Jumlah);
            
            
            // Modify the "Delete" link's href attribute with the actual panenId.id
            $('#' + formId + ' .delete-panen-link').attr('href', 'report/panen-delete/' + panenId.id);
            // $('#' + formId + ' .delete-panen-link').attr('href', url('/admin/mylea/report/panen-delete/' + panenId.id));


        });

        // Add an event listener to the "Close" button
        $('.modal').on('hide.bs.modal', function () {
            // Get the form ID from the data attribute of the modal
            var formId = $(this).data('form-id');

            // Hide the corresponding form
            $('#' + formId).hide();
        });
    });
</script>








  

  