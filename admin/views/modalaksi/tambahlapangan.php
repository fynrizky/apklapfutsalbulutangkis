<div class="modal fade" id="tambahlapangan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Users</h4>
      </div>
            <div class="modal-body">

            
             <?php
                if (isset($_POST['simpan'])) {


                  $namalapangan = $_POST['namalapangan'];
                  $hargasewa = $_POST['hargasewa'];

                    $extensi = explode(".", $_FILES['gambar']['name']);
                    $gambar = "gbr-" . round(microtime(true)) . "." . end($extensi);
                    $sumber = $_FILES['gambar']['tmp_name'];
                    $upload = move_uploaded_file($sumber, "../assets/img/". $gambar);

                    if($upload){
                        
                      $lapangan->simpan_lapangan(
                        $koneksi,
                        $namalapangan,
                        $hargasewa,
                        $gambar
                    );
                        // echo "<div class='alert alert-info alert-dismissable' id='divAlert'>
                        //             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        //             Data Tersimpan
                        //             </div>";
                        echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
                        echo "<script>window.location.href='?page=lapangan';</script>";
                    }else{

                        echo "<script>alert('Data Gagal Di Tambahkan');</script>";
                        echo "<script>window.location.href='?page=lapangan';</script>";
                    }
                }
                ?>

                <form action="" id="forminput" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="namalapangan">Nama Lapangan</label>
                        <input type="text" id="namalapangan" name="namalapangan" class="form-control" placeholder="Masukan Nama lapangan" required="">
                        <div id="showresult" style="padding-top:4px; padding-bottom:0;"></div>
                    </div>
                    <div class="form-group">
                        <label for="hargasewa">Harga Sewa</label>
                        <input type="number" id="hargasewa" name="hargasewa" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" required>
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