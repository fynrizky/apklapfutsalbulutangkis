<?php 
if(!@$_SESSION['pelanggan']){
    echo "<script>alert('maaf anda harus login');</script>";
    echo "<script>window.location.href='?page=loginpl';</script>";
}

?>


<div class="container mt-4">
<div class="card text-white bg-dark">
    <?php 
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, jadwal_sewa.jam_sewa, penyewaan.id_jadwal_sewa,
        lapangan.harga_sewa, lapangan.gambar, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, 
        penyewaan.selisih_jam, penyewaan.tgl_penyewaan, penyewaan.status, penyewaan.batas_waktu_dp FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
        WHERE penyewaan.id_pelanggan= '$_GET[id]' AND penyewaan.tgl_penyewaan='$_GET[tglsewa]'");
        $jmldata = $qry->num_rows;
        
        ?>
    <h5 class="card-header">
    Detail Pesan Lapangan
    </h5>
        <div class="card-body">
<?php 
            $data = $qry->fetch_object()
?>

            <div class="container mt-4">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="card text-white bg-dark mb-4">
                                <img src="assets/img/<?= $data->gambar; ?>" class="card-img-top" alt="..." height="125px"> 
                                    <div class="card-body">
                                    <?php $_SESSION['idlapangan'] = $data->id_lapangan; ?>
                                    <h5 class="card-title"><?= $data->nama_lapangan; ?></h5>

                                    <?php 
                                    $potongtgl = explode("/", date('Y/m/d', strtotime($data->tgl_penyewaan)));
                                    $potongbln = explode("/", date('Y/m/d', strtotime($data->tgl_penyewaan)));
                                    $potongtahun = substr(date('d/m/Y', strtotime($data->tgl_penyewaan)),-4);
                                    $ptgth = substr($potongtahun,2);
                                    ?>

                                    <?php 

                                    $idpl = "BOK-". end($potongtgl) . next($potongbln) . $ptgth;
                                    $idlapangan = $_SESSION['idlapangan'];
                                    $kode = $idpl . $idlapangan . $_SESSION['pelanggan']['id_pelanggan'];
                                    
                                    ?>



                                    <h6 class="card-subtitle mb-2 text" style="color:lightblue;"><?= $kode; ?></h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= ucwords($data->nama_pelanggan); ?></h6>
                                    <h6 class="card-subtitle mb-2 text-muted">Main <?= ucwords($data->selisih_jam) * $jmldata; ?> Jam</h6>
<?php
$tgl_penyewaan = $data->tgl_penyewaan;
$pelanggan = $data->id_pelanggan;
                
$qry2 = $koneksi->query("SELECT * FROM jadwal_sewa 
INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan = '$tgl_penyewaan'"); 
  ?>

                                    <?php while($row = $qry2->fetch_object()){ ?>
                                    <h6 class="card-subtitle mb-2 text-muted">(<?= $row->jam_sewa; ?>)</h6>
                                    <?php } ?>
                                    <h6 class="card-subtitle mb-2 text-muted">Total Rp. <?= number_format($total = $data->harga_sewa * $jmldata); ?>,-</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                    Status <?= $data->status == 'Menunggu Konfirmasi' ? 
                                    '<span class="badge badge-pill badge-danger">Bocked</span>' : 
                                    ($data->status == 'Pembayaran DP' ? '<span class="badge badge-pill badge-primary">Pembayaran DP</span>' : 
                                    '<span class="badge badge-pill badge-success">Success</span>'); ?></h6>

                                        <?php 
                                        $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$_SESSION[idlapangan]'"); 
                                        $row = $query->fetch_assoc();
                                            $persen = 50/100;
                                            $dp = $row['harga_sewa'] * $persen;
                                            $pelunasan = $total - $dp;
                                        ?>
                                    
                                    <?php 
                                    if($data->status == 'Pembayaran DP')
                                    {
                                    ?>
                                    <h6 class="card-subtitle mb-2 text-muted"><span style="color:white;">Sisa Pelunasan Rp. <?= number_format($pelunasan); ?>,-</span></h6>
                                    <?php 
                                    }
                                    ?>
                                    <h6 class="card-subtitle mb-2 text-muted">Tanggal Sewa <?= date('d/m/Y', strtotime($data->tgl_penyewaan)); ?></h6>
                                    <?php if($data->status == 'Menunggu Konfirmasi') { ?>
                                        <?php 
                                        $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$_SESSION[idlapangan]'"); 
                                        $row = $query->fetch_assoc();
                                            $persen = 50/100;
                                            $dp = $row['harga_sewa'] * $persen;
                                        ?>
                                    <p style="color: red;"> SILAHKAN LAKUKAN PEMBAYARAN DP <span style="color: white;">Rp. <?= number_format($dp); ?>,-</span></p>
                                    <!-- <p style="color: red;"> PELUNASAN BISA DILAKUKAN PADA HARI PENYEWAAN</p> -->
                                    <?php } ?>

                                    <?php if($data->status == 'Pembayaran DP'): ?>
                                    <h6 class="card-subtitle mb-2 text-muted"><span style="color:white;">PENTING !! <?= $data->batas_waktu_dp; ?></span></h6>
                                    <?php endif; ?>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                                    

        </div>
</div> 
</div>