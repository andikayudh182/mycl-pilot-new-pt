<div class="modal fade" id="FormRebusModal{{$data['id']}}" tabindex="-1" aria-labelledby="FormRebusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{$data['KPMylea']}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('/admin/post-treatment/data-panen/submit-rebus')}}" method="POST">
                @csrf
                <input type="hidden"  name="PanenID" value="{{$data['id']}}">
                <div class="row mb-3 ">
                    <label for="Tanggal" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Pengerjaan :</label>
                    <div class="col-sm-5">
                        <input type="date"  name="Tanggal" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm">
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
                        <input type="number" name="JumlahOri" class="form-control form-control-sm @error('JumlahOri') is-invalid @enderror" id="colFormLabelSm">
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
                        <input type="number" name="JumlahBlack" class="form-control form-control-sm @error('JumlahBlack') is-invalid @enderror" id="colFormLabelSm">
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
                        <input type="number" name="JumlahTotal"  class="form-control form-control-sm" id="colFormLabelSm" readonly>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script>
    // Dapatkan semua tombol yang memicu modal
    var modalButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    
    // Loop melalui setiap tombol
    modalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var modalId = button.getAttribute('data-bs-target').replace('#', ''); // Ambil ID modal yang sesuai
            var modal = document.getElementById(modalId);
            var JumlahOriInput = modal.querySelector('[name="JumlahOri"]');
            var JumlahBlackInput = modal.querySelector('[name="JumlahBlack"]');
            var JumlahTotalInput = modal.querySelector('[name="JumlahTotal"]');
            
            function tesFunction() {
                var JumlahOri = parseInt(JumlahOriInput.value) || 0;
                var JumlahBlack = parseInt(JumlahBlackInput.value) || 0;
        
                // Lakukan perhitungan jumlah
                var JumlahTotal = JumlahOri + JumlahBlack;
        
                // Update nilai pada input "Jumlah Total"
                JumlahTotalInput.value = JumlahTotal;
        
                // Tampilkan nilai pada console.log
                console.log("Jumlah Ori:", JumlahOri);
                console.log("Jumlah Black:", JumlahBlack);
                console.log("Jumlah Total:", JumlahTotal);
            }
            
            // Tambahkan event listener untuk mendengarkan perubahan pada input "JumlahOri" dan "JumlahBlack"
            JumlahOriInput.addEventListener('input', tesFunction);
            JumlahBlackInput.addEventListener('input', tesFunction);
        });
    });
</script>






