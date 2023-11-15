<!-- Modal -->
<div class="modal fade" id="updateRebus{{ $item['id'] }}" tabindex="-2" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Rebus</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/admin/post-treatment/data-panen/update-rebus')}}" method="POST">
                @csrf
                <input type="hidden"  name="updateId" value="{{$item['id']}}">
                <div class="row mb-3 ">
                    <label for="Tanggal" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="updateTanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm" value="{{ $item['Tanggal'] }}">
                        @error('Tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah Ori :</label>
                    <div class="col-sm-5">
                        <input type="number" name="updateJumlahOri" class="form-control form-control-sm @error('JumlahOri') is-invalid @enderror" id="colFormLabelSm" value="{{ $item['JumlahOri'] }}">
                        @error('JumlahOri')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah Black :</label>
                    <div class="col-sm-5">
                        <input type="number" name="updateJumlahBlack" class="form-control form-control-sm @error('JumlahBlack') is-invalid @enderror" id="colFormLabelSm" value="{{ $item['JumlahBlack'] }}">
                        @error('JumlahBlack')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Jumlah" class="col-sm-4 col-form-label col-form-label-sm">Jumlah Total :</label>
                    <div class="col-sm-5">
                        <input type="number" name="updateJumlahTotal"  class="form-control form-control-sm" id="colFormLabelSm" value="{{ $item['JumlahRebus'] }}" readonly>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>


<script>
    // Dapatkan semua tombol yang memicu modal
    var updateModalButtons = document.querySelectorAll('[data-toggle="modal"]');
    
    // Loop melalui setiap tombol
    updateModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var updateModalId = button.getAttribute('data-target').replace('#', ''); // Ambil ID modal yang sesuai
            var updateModal = document.getElementById(updateModalId);
            var updateJumlahOriInput = updateModal.querySelector('[name="updateJumlahOri"]');
            var updateJumlahBlackInput = updateModal.querySelector('[name="updateJumlahBlack"]');
            var updateJumlahTotalInput = updateModal.querySelector('[name="updateJumlahTotal"]');
            
            function updateTesFunction() {
                var updateJumlahOri = parseInt(updateJumlahOriInput.value) || 0;
                var updateJumlahBlack = parseInt(updateJumlahBlackInput.value) || 0;
        
                // Lakukan perhitungan jumlah
                var updateJumlahTotal = updateJumlahOri + updateJumlahBlack;
        
                // Update nilai pada input "Jumlah Total"
                updateJumlahTotalInput.value = updateJumlahTotal;
        
                // Tampilkan nilai pada console.log
                console.log("Jumlah Ori:", updateJumlahOri);
                console.log("Jumlah Black:", updateJumlahBlack);
                console.log("Jumlah Total:", updateJumlahTotal);
            }
            
            // Tambahkan event listener untuk mendengarkan perubahan pada input "updateJumlahOri" dan "updateJumlahBlack"
            updateJumlahOriInput.addEventListener('input', updateTesFunction);
            updateJumlahBlackInput.addEventListener('input', updateTesFunction);
        });
    });
</script>

  
 