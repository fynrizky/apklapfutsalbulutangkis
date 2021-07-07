<div class="modal fade" id="ubahtransaksi" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Transaksi</h4>
      </div>
        <div class="modal-body" id="modal-edit">
            <form action="" id="forminputtransaksi" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="status">Update Status</label>
                        <!-- <input type="hidden" id="idtransaksi" name="idtransaksi"> -->
                        <input type="hidden" id="idpelanggan" name="idpelanggan">
                        <input type="hidden" id="tgl" name="tgl">
                        <select name="status" id="status" class="form-control" required>
                            <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                            <option value="Pembayaran DP">DP</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="batasdp">Pesan Batas DP</label>
                        <textarea type="text" class="form-control" id="batasdp" name="batasdp" placeholder="Isi Pesan"></textarea>
                    
                    </div> -->
                  
                  
          </div><!-- modal body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="ubahtransaksi"><i class="fa fa-paper-plane"></i>Update </button>
                    </div>
                </form>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
