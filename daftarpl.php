
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 ml-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pelanggan</h3>
                </div>
                <div class="card-body">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="emailpl" class="control-label">Email</label>
                            
                                <input type="email" class="form-control" name="emailpl" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="namapl" class="control-label">Nama</label>
                            
                                <input type="text" class="form-control" name="namapl" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="passwordpl" class="control-label">Password</label>
                            
                                <input type="password" class="form-control" name="passwordpl" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="notelppl" class="control-label">Nomor Telp/Hp</label>
                            
                                <input type="text" class="form-control" name="notelppl" required>
                            
                        </div>
                        <div class="form-group">
                            
                                <button type="submit" name="daftarpelanggan" class="btn btn-primary">Daftar</button>
                            
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['daftarpelanggan'])){

                            $emailpl=$_POST['emailpl'];
                            $namapl=$_POST['namapl'];
                            $passwordpl=$_POST['passwordpl'];
                            $notelppl=$_POST['notelppl'];

                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$emailpl'");
                            $yangcocok = $ambil->num_rows;
                            if($yangcocok == 1){//kalau ada yg cocok di database == 1
                                echo "<script>alert('pendaftaran gagal email sudah digunakan');</script>";
                                echo "<script>location.href='?page=daftarpl';</script>";
                            }else{
                                $koneksi->query("INSERT INTO pelanggan (email_pelanggan,nama_pelanggan,password_pelanggan,notelp)
                                VALUES('$emailpl','$namapl','$passwordpl','$notelppl')");

                                echo "<script>alert('Pendaftaran Berhasil Silahkan Login');</script>";
                                echo "<script>location.href='?page=halutama';</script>";
                            }

                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    