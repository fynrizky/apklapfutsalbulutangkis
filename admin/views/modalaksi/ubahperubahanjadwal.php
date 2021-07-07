<div class="modal fade" id="ubahperubahan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Perubahan</h4>
      </div>
        <div class="modal-body" id="modal-edit">
            <form action="" id="forminputperubahanjadwal" method="post" enctype="multipart/form-data">
                   
            <div class="form-group">
                        <label for="pl">Pelanggan</label>
                        <input type="hidden" id="idperubahan" name="idperubahan">
                        <?php $query = $koneksi->query("SELECT * FROM pelanggan"); ?>
                        <select name="pl" id="pl" class="form-control">
                            <option value="">-Pilih-</option>
                            <?php if($query->num_rows > 0) { ?>
                            <?php while($row = $query->fetch_assoc()) { ?>
                            <option value="<?= $row['id_pelanggan'] ?>"><?= ucwords($row['nama_pelanggan']) ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lapangan">Lapangan Berubah</label>
                        <?php $query = $koneksi->query("SELECT * FROM lapangan"); ?>
                        <select name="lapangan" id="lapangan" class="form-control">
                            <option value="">-Pilih Perubahan lapangan-</option>
                            <?php if($query->num_rows > 0) { ?>
                            <?php while($row = $query->fetch_assoc()) { ?>
                            <option value="<?= $row['id_lapangan'] ?>"><?= $row['nama_lapangan'] ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="jamberubah">Jam Berubah</label>
                        <input type="text" id="jamberubah" name="jamberubah" class="form-control" placeholder="Jam Berubah" required>
                    </div>
                  
          </div><!-- modal body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="ubahperubahanjadwal"><i class="fa fa-paper-plane"></i>Update </button>
                    </div>
                </form>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
