<div class="modal fade" id="ubahpl" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update pelanggan</h4>
      </div>
        <div class="modal-body" id="modal-edit">
            <form action="" id="forminputpelanggan" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="emailpl">Email Pelanggan</label>
                        <input type="hidden" id="idpl" name="idpl">
                        <input type="text" id="emailpl" name="emailpl" class="form-control" placeholder="Ganti Email Pelanggan" required="">
                    </div>
                    <div class="form-group">
                        <label for="namapl">Nama Pelanggan</label>
                        <input type="text" id="namapl" name="namapl" class="form-control" placeholder="Ganti Nama Pelanggan" required="">
                    </div>

                    <div class="form-group">
                        <label for="passwordpl">Password</label>
                        <input type="password" id="passwordpl" name="passwordpl" class="form-control" placeholder="Masukan Password Baru">
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordpl2">Password Confirm</label>
                        <input type="password" id="passwordpl2" name="passwordpl2" class="form-control" placeholder="Masukan Password Confirm">
                    </div>

                    <div class="form-group">
                        <label for="notelppl">Nomor Telp</label>
                        <input type="text" id="notelppl" name="notelppl" class="form-control" placeholder="Ganti No Telp Pelanggan" required="">
                    </div>
                  
          </div><!-- modal body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="ubahpelanggan"><i class="fa fa-paper-plane"></i>Update </button>
                    </div>
                </form>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
