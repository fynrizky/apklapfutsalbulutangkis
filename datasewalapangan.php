<?php 
if(!@$_SESSION['pelanggan']){
    echo "<script>alert('maaf anda harus login');</script>";
    echo "<script>window.location.href='?page=loginpl';</script>";
}

?>

<div class="container mt-4">
<div class="card text-white bg-dark">
    
    <h5 class="card-header">
    Data Jadwal Sewa Lapangan 
    </h5>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <!-- <div class="col d-flex justify-content-center"> -->
                        <div class="col-md-12">
                            <div class="card text-dark bg-light mb-4">
                                    <h5 class="card-header">
                                    Jadwal Lapangan
                                    </h5>
                                    <div class="card-body">
                                        
                                        <!-- form -->
                                        
<section class="content-header mb-4">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="row">
        <div class="col-lg-12">
        <form action="" method="POST" class="form-inline">
			<div class="col-lg">
				<div class="form-group">
					<input type="date" id="tgl" value="<?= date('Y-m-d'); ?>" class="form-control" name="tgl">
				</div>
			</div>
			<div class="col-lg">
				<div class="form-group">
                <?php $qry = $koneksi->query("SELECT * FROM lapangan"); ?>
					<select name="lapangan" id="lapangan" class="form-control">
                        <option value="">--PILIH LAPANGAN--</option>
                <?php while($data = $qry->fetch_array()){  ?>
                        <option value="<?=$data['id_lapangan']?>"><?= $data['nama_lapangan'] ?></option>
                <?php } ?>
                    </select>
				</div>
			</div>
			<div class="form-group">
            <div class="float-right">
				<button id="formbtn" name="prosess" class="btn btn-default"><i class="fa fa-play-circle"></i> Prosess</button>
            </div>
			</div>
		</form>
        </div>
    </div>
</div>
</section>

<section>
  <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Sewa</h6>
            </a>
            <!-- Card Content -Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lapangan</th>
                                            <th>Jam Sewa</th>
                                            <th>Tanggal Penyewaan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(@$_GET['tgl'] && @$_GET['lapangan']){
                                    ?>
                                    
                                    <?php $no = 1; ?>
                                        <?php //$query = $supp->tampilsupp($koneksi); ?>
                                        
                                        <?php $query = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.id_lapangan,
                                        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
                                        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
                                        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
                                        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
                                        WHERE penyewaan.tgl_penyewaan = '$_GET[tgl]' AND penyewaan.id_lapangan = '$_GET[lapangan]' ORDER BY penyewaan.id_penyewaan DESC
                                        "); ?>
                                        <?php
                                        if($query->num_rows > 0){ 
                                        while ($data = $query->fetch_array()) { 
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <!-- <td><?= ucwords($data['nama_pelanggan']); ?></td> -->
                                                <td><?= ucwords($data['nama_lapangan']); ?></td>
                                                <td>
                                                <?php $pelanggan = $data['id_pelanggan']; ?>
                                                <?php //$tgl_penyewaan = $data['tgl_penyewaan']; ?>
                                                <?php  
                                                $qry = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa
                                                WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan = '$_GET[tgl]' AND penyewaan.id_lapangan = '$_GET[lapangan]'"); 
                                                ?>
                                                <?php while($row = $qry->fetch_array()): ?>
                                                <?= ucwords($row['jam_sewa'])."<br>"; ?>
                                                <?php endwhile; ?>
                                                </td>
                                                <?php  $qry2 = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
                                                WHERE penyewaan.tgl_penyewaan='$_GET[tgl]' AND penyewaan.id_lapangan = '$_GET[lapangan]'");  ?>
                                                <?php $row = $qry2->fetch_array(); ?>
                                                <td><?= $row['tgl_penyewaan']; ?></td>
                                                <td><?= ucwords($data['status']) == 'Menunggu Konfirmasi' ? '<span class="badge badge-pill badge-danger">Bocked</span>' : 
                                                ($data['status'] == 'Pembayaran DP' ? '<span class="badge badge-pill badge-danger">Bocked</span>' :
                                                '<span class="badge badge-pill badge-primary">Pakai</span>'); ?></td>
                                               
                                            </tr>
                                        <?php } ?>
                                    
                                    <?php 
                                    }
                                    ?>
                                    <?php 
                                    }
                                    ?>


                                    <!-- jika tombol proses di pencet -->
                                    <?php 
                                    if(isset($_POST['prosess'])){
                                       
                                    ?>
                                        <?php $no = 1; ?>
                                        <?php //$query = $supp->tampilsupp($koneksi); ?>
                                        
                                        <?php $query = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.id_lapangan,
                                        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
                                        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
                                        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
                                        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
                                        WHERE penyewaan.tgl_penyewaan = '$_POST[tgl]' AND penyewaan.id_lapangan = '$_POST[lapangan]' ORDER BY penyewaan.id_penyewaan DESC
                                        "); ?>
                                        <?php
                                        if($query->num_rows > 0){ 
                                        while ($data = $query->fetch_array()) { 
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <!-- <td><?= ucwords($data['nama_pelanggan']); ?></td> -->
                                                <td><?= ucwords($data['nama_lapangan']); ?></td>
                                                <td>
                                                <?php $pelanggan = $data['id_pelanggan']; ?>
                                                <?php  $qry = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
                                                WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan = '$_POST[tgl]' AND penyewaan.id_lapangan = '$_POST[lapangan]'");  
                                                ?>
                                                <?php while($row = $qry->fetch_array()): ?>
                                                <?= ucwords($row['jam_sewa'])."<br>"; ?>
                                                <?php endwhile; ?>
                                                </td>
                                                <?php  $qry2 = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
                                                WHERE penyewaan.tgl_penyewaan='$_POST[tgl]' AND penyewaan.id_lapangan = '$_POST[lapangan]'");  
                                                ?>
                                                <?php $row = $qry2->fetch_array(); ?>
                                                <td><?= $row['tgl_penyewaan']; ?></td>
                                                <td><?= ucwords($data['status']) == 'Menunggu Konfirmasi' ? '<span class="badge badge-pill badge-danger">Bocked</span>' : 
                                                ($data['status'] == 'Pembayaran DP' ? '<span class="badge badge-pill badge-danger">Bocked</span>' :
                                                '<span class="badge badge-pill badge-primary">Pakai</span>'); ?></td>
                                               
                                            </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    <?php }else{ ?>
                


                                    
                                     <!-- jika data jadwal sewa di pencet -->
                                    <?php 
                                    if(isset($_GET['tglskrg'])){
                                       
                                    ?>
                                        <?php $no = 1; ?>
                                        <?php //$query = $supp->tampilsupp($koneksi); ?>
                                        
                                        <?php $query = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.id_lapangan,
                                        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
                                        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
                                        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
                                        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
                                        WHERE penyewaan.tgl_penyewaan = '$_GET[tglskrg]' ORDER BY penyewaan.id_penyewaan DESC
                                        "); ?>
                                        <?php
                                        if($query->num_rows > 0){ 
                                        while ($data = $query->fetch_array()) { 
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <!-- <td><?= ucwords($data['nama_pelanggan']); ?></td> -->
                                                <td><?= ucwords($data['nama_lapangan']); ?></td>
                                                <td>
                                                <?php $pelanggan = $data['id_pelanggan']; ?>
                                                <?php  $qry = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
                                                WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan='".$_GET['tglskrg']."'");  ?>
                                                <?php while($row = $qry->fetch_array()): ?>
                                                <?= ucwords($row['jam_sewa'])."<br>"; ?>
                                                <?php endwhile; ?>
                                                </td>
                                                <?php  $qry2 = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa 
                                                WHERE penyewaan.tgl_penyewaan='$_GET[tglskrg]'");  ?>
                                                <?php $row = $qry2->fetch_array(); ?>
                                                <td><?= $row['tgl_penyewaan']; ?></td>
                                                <td><?= ucwords($data['status']) == 'Menunggu Konfirmasi' ? '<span class="badge badge-pill badge-danger">Bocked</span>' : 
                                                ($data['status'] == 'Pembayaran DP' ? '<span class="badge badge-pill badge-danger">Bocked</span>' :
                                                '<span class="badge badge-pill badge-primary">Pakai</span>'); ?></td>
                                               
                                            </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    <?php } ?>

                                    <!-- tutup else -->
                                    <?php } ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>                 
                                    
                                    </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
</div> 
</div>
                        </div>