<div class="modal fade" id="tambahjadwalsewa" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Waktu</h4>
      </div>
            <div class="modal-body">

            <?php
                 if (isset($_POST['simpan'])) {

                    $jamsewa = $_POST['jamsewa'];
                    

                    $jadwalsewa->simpan_sewa(
                        $koneksi,
                        $jamsewa
                    );
                    echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
                    echo "<script>window.location.href='?page=jadwalsewa';</script>";
                }
            ?>

                <form action="" id="forminput" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="jamsewa">Jam Sewa</label>
                        <input type="text" id="jamsewa" name="jamsewa" class="form-control" placeholder="Jam Sewa (Contoh: 08:00 - 09:00)" required="">
                        <div id="showresult" style="padding-top:4px; padding-bottom:0;"></div>
                    </div>
                  

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button id="formbtn" class="btn btn-primary btn-sm" name="simpan"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->