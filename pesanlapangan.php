<?php 
if(!@$_SESSION['pelanggan']){
    echo "<script>alert('maaf anda harus login');</script>";
    echo "<script>window.location.href='?page=loginpl';</script>";
}

?>
<div class="container mt-4">
<div class="row"> <!-- row -->

<?php 
if(isset($_GET['idbatal']))
{
$id = $_GET['idbatal'];
$koneksi->query("DELETE FROM penyewaan WHERE id_penyewaan = '$id'");
echo "<script>alert('Penyewaan Berhasil Dibatalkan');</script>";
echo "<script>window.location.href='?page=halutama';</script>";
} 
?>




<div class="col-md-4">
<div class="card text-white bg-dark">
<?php 
    $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan='$_GET[id]'"); 
    $data = $query->fetch_assoc();
?>
  <h5 class="card-header">Sewa <?= $data['nama_lapangan']." - Rp. ".number_format($data['harga_sewa']); ?>,-</h5>
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <?php $query = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = ".$_SESSION['pelanggan']['id_pelanggan'].""); ?>
        <?php $data = $query->fetch_object();?>
        <label for="pelanggan">Pelanggan</label>
        <select name="pelanggan" id="pelanggan" class="form-control" readonly>
            <option value="<?= $data->id_pelanggan ?>"><?= ucwords($data->nama_pelanggan) ?></option>
        </select>
    </div>

    <div class="form-group">
        <label for="idjadwalsewa">Jam Main</label>
        <?php $query = $koneksi->query("SELECT * FROM jadwal_sewa ORDER BY id_jadwal_sewa"); ?>
        <select name="idjadwalsewa" id="idjadwalsewa" class="form-control" required="">
            <option value="">-PILIH JAM MAIN-</option>
        <?php while ($data = $query->fetch_object()): ?>
            <option value="<?= $data->id_jadwal_sewa ?>"><?= $data->jam_sewa; ?></option>
        <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tgl_sewa">DP (50% dari harga sewa lapangan/Jam)</label>
        <?php 
          $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan='$_GET[id]'"); 
          $data = $query->fetch_assoc();
            $persen = 50/100;
            $dp = $data['harga_sewa'] * $persen;
        ?>
        <input type="text" name="tgl_sewa" readonly id="tgl_sewa" value="Rp. <?= number_format($dp); ?>,-" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="tgl_sewa">Tanggal Sewa</label>
        <input type="date" name="tgl_sewa" id="tgl_sewa" value="<?= date('Y-m-d'); ?>" class="form-control" required>
        <input type="hidden" name="tgl_pesan" id="tgl_pesan" value="<?= date('Y-m-d'); ?>" class="form-control">
    </div>
    <button type="submit" name="tambahsewapl" id="tambahsewapl" class="btn btn-primary"><i class="fa fa-plane"></i> Save</button>
    <?php $query = $koneksi->query("SELECT * FROM penyewaan WHERE id_pelanggan = ".$_SESSION['pelanggan']['id_pelanggan']." AND id_lapangan=".$_GET['id'].""); ?>
    <?php if($query->num_rows > 0): ?>
    <?php $data = $query->fetch_array(); ?>
    <a class="btn btn-secondary" target="blank" href="?page=detailpesanlapangan&id=<?= $_SESSION['pelanggan']['id_pelanggan'] ?>&tglsewa=<?= @$_SESSION['tglsewa'] == TRUE ? $_SESSION['tglsewa'] : $data['tgl_penyewaan'] ;//lihat baris 160-163 ?>"><i class="fa fa-user"></i> Lihat Detail Sewa</a>
    <?php endif; ?>
    </form>
  </div>
</div>
</div>




<?php 
    if(isset($_POST['tambahsewapl']))
    {
        $idpl = $_POST['pelanggan'];
        $lapangan = $_GET['id'];
        $idjadwalsewa = $_POST['idjadwalsewa'];
        $tglsewa = $_POST['tgl_sewa'];
        $tglpesan = $_POST['tgl_pesan'];
        $dibayar = '0';
        $status = 'Menunggu Konfirmasi';
        
        

        // Cek data
        $query = $koneksi->query("SELECT * FROM penyewaan WHERE id_pelanggan!='$idpl'
        AND id_lapangan='$lapangan' AND id_jadwal_sewa='$idjadwalsewa' AND tgl_penyewaan='$tglsewa'");

        
        $ygcocok = $query->num_rows;
        
        // if($ygcocok > 0)
        if($ygcocok === 1)
        {
            $data = $query->fetch_assoc();

            echo "<script>alert('Data Gagal Di Tambahkan Silahkan Cek Data Jadwal Sewa Lapangan Dulu');</script>";
            echo "<script>window.location.href='?page=datasewalapangan&tgl=".$tglsewa."&lapangan=".$lapangan."';</script>";
        }else{

             
            $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan='$lapangan'");
            $data = $query->fetch_object();

            // $hargasewa = $data->harga_sewa;
        
            $selisihjam = 1;
            // $totalhargasewa = $hargasewa * $selisihjam;
            
            // $hasil = (intval($jamselesai) - intval($jammulai)) * 60;
            // $selisihjam = $hasil/60;


            $koneksi->query("INSERT INTO penyewaan(id_pelanggan,id_lapangan,id_jadwal_sewa,dibayar,selisih_jam,tgl_pemesanan,tgl_penyewaan,status) 
            VALUES('$idpl','$lapangan','$idjadwalsewa','$dibayar','$selisihjam','$tglpesan','$tglsewa','$status')");
            echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
            echo "<script>window.location.href='?page=pesanlapangan&id=".$_GET['id']."';</script>";
        }
    }

?>




<div class="col-md-8">
<div class="card text-white bg-dark">
  <h5 class="card-header">Data Sewa</h5>
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <?php $pelanggan = $_SESSION['pelanggan']['id_pelanggan']; ?>
    <?php $query = $koneksi->query("SELECT * FROM penyewaan
    INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
    INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
    INNER JOIN pelanggan ON penyewaan.id_pelanggan = pelanggan.id_pelanggan 
    WHERE penyewaan.id_pelanggan='$pelanggan' AND penyewaan.id_lapangan='$_GET[id]'"); ?>
    
    <div class="container mt-4">
    <div class="row">
    <?php if($query->num_rows > 0) { ?> <!-- cek datanya pada baris didatabase berdasarkan id_pelanggan apakah data nya ada jika lebih dr 0 brrti datanya ada -->
    <?php while ($data = $query->fetch_object()){ ?>
    <div class="col-md-6">
    <div class="card text-white bg-dark mb-4">
    <img src="assets/img/<?= $data->gambar; ?>" class="card-img-top" alt="..." height="125px"> 
    <div class="card-body">
        <h5 class="card-title"><?= $data->nama_lapangan; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= ucwords($data->nama_pelanggan); ?></h6>
        <h6 class="card-subtitle mb-2 text-muted">Main <?= ucwords($data->selisih_jam); ?> Jam (<?= $data->jam_sewa ?>)</h6>
        <h6 class="card-subtitle mb-2 text-muted">Total Rp. <?= number_format($data->harga_sewa); ?>,-</h6>
        <h6 class="card-subtitle mb-2 text-muted">
        Status <?= $data->status == 'Menunggu Konfirmasi' ? 
        '<span class="badge badge-pill badge-danger">Bocked</span>' : 
        ($data->status == 'Pembayaran DP' ? '<span class="badge badge-pill badge-primary">Pembayaran DP</span>' : 
        '<span class="badge badge-pill badge-success">Success</span>'); ?></h6>
        <?php $_SESSION['tglsewa'] = $data->tgl_penyewaan; ?>
        <h6 class="card-subtitle mb-2 text-muted">Tanggal Sewa <?= date('d/m/Y', strtotime($_SESSION['tglsewa'])); ?></h6>
            <!-- <a href="?page=detailpesanlapangan&id=<?= $_SESSION['idpl'] = $data->id_pelanggan ?>" class="card-link">Detail Penyewaan</a> -->

        <?php if($data->status != 'Lunas') { ?>
            <a href="?page=pesanlapangan&idbatal=<?= $data->id_penyewaan; ?>" class="card-link" onclick="return confirm('Yakin Ingin Batalkan ?')">Batal Sewa</a>
        <?php } ?>
    </div>
    </div>
    </div>
   

    <?php } ?>
    <?php } ?>
    </div>
    </div>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
</div>

</div><!-- row -->
</div>