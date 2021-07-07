<div class="modal fade" id="tambahpelanggan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Pelanggan</h4>
      </div>
            <div class="modal-body">

            <?php 
            if(isset($_POST['simpanpl']))
            {
                $emailpl = $_POST['emailpl'];
                $namapl = $_POST['namapl'];
                $passwordpl = $_POST['passwordpl'];
                $passwordpl2 = $_POST['passwordpl2'];
                $notelppl = $_POST['notelppl'];
                
                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$emailpl'");
                $yangcocok = $ambil->num_rows;
                if($yangcocok == 1){//kalau ada yg cocok di database == 1
                  echo "<script>alert('pendaftaran gagal email sudah digunakan');</script>";
                  echo "<script>location.href='?page=customer';</script>";
                  
                }else{
                  
                  //cek confirm password
                  if($passwordpl !== $passwordpl2 )
                  {
                    echo "<script>alert('Password Tidak Cocok');</script>";
                    echo "<script>window.location.href='?page=customer';</script>";
                    
                  }else{

                    
                    $pelanggan->simpan_pelanggan($koneksi,$emailpl,$namapl,$notelppl,$passwordpl);
                    
                    echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
                    echo "<script>window.location.href='?page=customer';</script>";
                  }
                }

                
            }
            ?>
            
            

                <form action="" id="forminput" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="emailpl">Email</label>
                        <input type="text" id="emailpl" name="emailpl" class="form-control" placeholder="Masukan Email Pelanggan" required="">
                        <div id="showresult" style="padding-top:4px; padding-bottom:0;"></div>
                    </div>
                    <div class="form-group">
                        <label for="namapl">Nama Pelanggan</label>
                        <input type="text" id="namapl" name="namapl" class="form-control" placeholder="Masukan Nama Pelanggan" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordpl">Password</label>
                        <input type="password" id="passwordpl" name="passwordpl" class="form-control" placeholder="Masukan Password Baru" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="passwordpl2">Password Confirm</label>
                        <input type="password" id="passwordpl2" name="passwordpl2" class="form-control" placeholder="Masukan Password Confirm" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="notelppl">No Telp</label>
                        <input type="number" id="notelppl" name="notelppl" class="form-control" placeholder="Masukan No Telp Pelanggan" required>
                    </div>
                    
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button id="formbtn" class="btn btn-primary btn-sm" name="simpanpl"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->