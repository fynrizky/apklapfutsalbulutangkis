<div class="modal fade" id="ubahlapangan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Lapangan</h4>
      </div>
        <div class="modal-body" id="modal-edit">
            <form action="" id="forminputlapangan" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="namalapangan">Nama Lapangan</label>
                        <input type="hidden" id="idlapangan" name="idlapangan">
                        <input type="text" id="namalapangan" name="namalapangan" class="form-control" placeholder="Nama Lapangan" required="">
                    </div>
                    <div class="form-group">
                        <label for="hargasewa">Harga Sewa Lapangan</label>
                        <input type="number" id="hargasewa" name="hargasewa" class="form-control" placeholder="Harga Sewa" required="">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control">
                        <br>
                        <div class="form-group">
                            <img src="" id="pict" width="100%">
                        </div>
                    </div>

                  
          </div><!-- modal body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="ubahlapangan"><i class="fa fa-paper-plane"></i>Update </button>
                    </div>
                </form>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
