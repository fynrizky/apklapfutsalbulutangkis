<div class="modal fade" id="tambahperubahan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Perubahan</h4>
      </div>
            <div class="modal-body">
 
                <?php 
                if(isset($_POST['simpanperubahanjadwal']))
                {
                    $pelanggan = $_POST['pl'];
                    $lapangan = $_POST['lapangan'];
                    $jamberubah = $_POST['jamberubah'];
                    $tgl = $_POST['tglpenyewaan'];
                    $statusperubahan = "Jadwal Berubah";

                    $perubahanjadwal->simpan_perubahan_jadwal($koneksi,$pelanggan,$lapangan,$jamberubah,$tgl,$statusperubahan);
                    echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
                    echo "<script>window.location.href='?page=perubahanjadwal';</script>";
                }
                
                ?>

                <form action="" id="forminput" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pl">Pelanggan</label>
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
                    
                    <div class="form-group">
                        <label for="tglpenyewaan">Tanggal Penyewaan</label>
                        <input type="date" id="tglpenyewaan" name="tglpenyewaan" class="form-control" value="<?= date('Y-m-d'); ?>" placeholder="Tanggal Penyewaan" required>
                    </div>
                    
                    <!-- <div class="form-group">
                        <label for="statusberubah">Status Berubah</label>
                        <input type="text" id="statusberubah" name="statusberubah" class="form-control" placeholder="Masukan Status" required>
                    </div> -->
                    
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button id="formbtn" class="btn btn-primary btn-sm" name="simpanperubahanjadwal"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->