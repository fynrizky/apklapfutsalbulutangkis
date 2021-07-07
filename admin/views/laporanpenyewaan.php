<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<section>
<div class="row">
          <div class="col-lg-12">
            <h1>Laporan Penyewaan <small> Report</small></h1>
    <div class="row">
		<div class="col-lg-12">
        <form method="post" class="form-inline" style="margin-bottom: 20px;">
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tgl1" value="<?= date('Y-m-d') ?>" class="form-control" name="tgl1">
                    </div>
                  </div>
                  <br>
                  <label> Hingga </label>
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tgl2" value="<?= date('Y-m-d') ?>" class="form-control" name="tgl2">
                    </div>
                  </div>
                  <br>
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
                  <hr/>
                  <div class="form-group">
                    <button type="submit" id="formbtn" name="prosess" class="btn btn-default"><i class="fa fa-play-circle"></i> Prosess</button>
                    <button class="btn btn-primary" name="semua"><i class="fa fa-list"></i> Semua Data</button>
                  </div>
		        </form>
		</div>
		</div>

                 <?php if (isset($_POST['prosess'])){ ?>
										<a href="?page=cetaklaporan&tgl1=<?= $_POST['tgl1']; ?>&tgl2=<?= $_POST['tgl2']; ?>&lapangan=<?= $_POST['lapangan'] ?>" target="_BLANK" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								 <?php } ?>
								<?php if (isset($_POST['semua'])){ ?>
										<a href="?page=cetaklaporan&semua" target="_BLANK" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								<?php } ?>
								<?php if (!isset($_POST['prosess']) && !isset($_POST['semua'])){ ?>
										<a href="#" class="btn btn-info btn-sm pull-right" disabled="disabled"><i class="fa fa-print"></i> Cetak</a>
								<?php } ?>
        
            <ol class="breadcrumb">
              <li><a href="?page=dashboard"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i> Blank Page</li>
            </ol>
          </div>
        </div><!-- /.row -->
</section>


  <!-- table -->
  
  <!-- <div class="container"> -->
  <div class="row">
  <div class="col-lg-12">
           
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book"></i> Data Transaksi</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>Pelanggan</th> -->
                            <th>Tanggal Penyewaan</th>
                            <th>Deskripsi</th>
                            <th>Total</th>
                            <th>Status Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    	if (isset($_POST['prosess'])) {
                        // $totalsewa = $laporan->hitung_total_penyewaan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);
                        $cek = $laporan->cek_penyewaan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);
                        if ($cek === false) {//jika tidak ada datanya
                          false;//tidak tampil atau false
                        }else{
                        $qry = $laporan->tampil_laporan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);


                    
                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <!-- <td><?= ucwords($data['nama_pelanggan']); ?></td> -->
                        
                        <td>
                        <?= date('d/m/Y', strtotime($data['tgl_penyewaan'])); ?>
                        </td>

                        <td>
                        <?php $_SESSION['lapangan'] = $data['id_lapangan']; ?>
                        <strong><?= $data['nama_lapangan']; ?></strong>
                        <br>
                        Jam Main    :
                        <br>
                        <?php 
                        $pelanggan = $data['id_pelanggan'];
                        $tgl_penyewaan = $data['tgl_penyewaan'];
                        $qry = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan = '$tgl_penyewaan'"); 
                        while($jam = $qry->fetch_array()){
                        ?>
                        <?= $jam['jam_sewa']."<br>"; ?>
                        <?php } ?>
                        <?php $selisihjam = $qry->num_rows; ?>
                        Lama Main   :
                        <br>
                        <?php echo $selisihjam; ?> Jam
                        </td>

                        <td>
                        <?php $total = $data['harga_sewa'] * $selisihjam;  ?>
                        <?php $_SESSION['total'] = $total; ?>
                        Rp. <?php echo number_format($_SESSION['total']);  ?>,-
                        </td>

                     
                        <td>
                        <?php echo
                        $data['status'] == 'Menunggu Konfirmasi' ? 
                        '<span class="label label-warning" style="border-radius: 100px; font-size: 12px; ">Menunggu Konfirmasi</span>' : 
                        ($data['status'] == 'Pembayaran DP' ? '<span class="label label-primary" style="border-radius: 100px; font-size: 12px; ">DP</span>' :
                        '<span class="label label-success" style="border-radius: 100px; font-size: 12px; ">Success</span>');
                        ?>
                        </td>
                        
                      
                      
                    </tr>
                    <?php 
                    // $pelanggan = $data['id_pelanggan'];
                    ?>
                    <?php } ?>
                    <?php } ?>
                    </tbody>
                            <?php $q = $koneksi->query("SELECT *, SUM(penyewaan.dibayar) AS total FROM penyewaan INNER JOIN lapangan ON penyewaan.id_lapangan=lapangan.id_lapangan 
                            WHERE penyewaan.id_lapangan='$_POST[lapangan]' AND penyewaan.status='Lunas' AND penyewaan.tgl_penyewaan BETWEEN '$_POST[tgl1]' AND '$_POST[tgl2]'"); ?>
                            <?php  
                            // $jml_data = $q->num_rows;
                            // $row = $q->fetch_array(); 
                            // $harga_sewa = $row['harga_sewa'];
                            // $totalkeseluruhan = $harga_sewa * $jml_data;
                             $row = $q->fetch_array(); 
                             $totalkeseluruhan = $row['total'];
                            ?>
                            
                   
                    <tfoot>
                            <td colspan="3" style="text-align: center;"><strong>Total Sewa Lunas</strong></td>
                            <?php $_SESSION['gtotal'] = $totalkeseluruhan; ?>
                            <td style="color: black;"><strong>Rp. <?php echo number_format($_SESSION['gtotal']); ?>,-</strong></td>
                                              
                    </tfoot>
                    <?php } 

                    //JIka tombol semua di pencet 
                    
                    	elseif (isset($_POST['semua'])) {
                        // $totalsewa = $laporan->hitung_total_penyewaan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);
                        $cek = $laporan->cek_penyewaan($koneksi);
                        if ($cek === false) {
                          false;
                        }else{
                        $qry = $laporan->tampil_laporan($koneksi);


                    
                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <!-- <td><?= ucwords($data['nama_pelanggan']); ?></td> -->
                        
                        <td>
                        <?= date('d/m/Y', strtotime($data['tgl_penyewaan'])); ?>
                        </td>

                        <td>
                        <?php $_SESSION['lapangan'] = $data['id_lapangan']; ?>
                        <strong><?= $data['nama_lapangan']; ?></strong>
                        <br>
                        Jam Main    :
                        <br>
                        <?php 
                        $pelanggan = $data['id_pelanggan'];
                        $tgl_penyewaan = $data['tgl_penyewaan'];
                        $qry = $koneksi->query("SELECT * FROM jadwal_sewa INNER JOIN penyewaan ON jadwal_sewa.id_jadwal_sewa=penyewaan.id_jadwal_sewa WHERE penyewaan.id_pelanggan = '$pelanggan' AND penyewaan.tgl_penyewaan = '$tgl_penyewaan'"); 
                        while($jam = $qry->fetch_array()){
                        ?>
                        <?= $jam['jam_sewa']."<br>"; ?>
                        <?php } ?>
                        <?php $selisihjam = $qry->num_rows; ?>
                        Lama Main   :
                        <br>
                        <?php echo $selisihjam; ?> Jam
                        </td>

                        <td>
                        <?php $total = $data['harga_sewa'] * $selisihjam;  ?>
                        Rp. <?php echo number_format($total);  ?>,-
                        </td>

                     
                        <td>
                        <?php echo
                        $data['status'] == 'Menunggu Konfirmasi' ? 
                        '<span class="label label-warning" style="border-radius: 100px; font-size: 8px; ">Menunggu Konfirmasi</span>' : 
                        ($data['status'] == 'Pembayaran DP' ? '<span class="label label-primary" style="border-radius: 100px; font-size: 12px; ">DP</span>' :
                        '<span class="label label-success" style="border-radius: 100px; font-size: 8px; ">Success</span>');
                        ?>
                        </td>
                        
                      
                      
                    </tr>
                    <?php 
                    // $pelanggan = $data['id_pelanggan'];
                    ?>
                    <?php } ?>
                    <?php } ?>
                    </tbody>
                            <?php 
                            $q = $koneksi->query("SELECT *, SUM(penyewaan.dibayar) AS total FROM penyewaan INNER JOIN lapangan ON penyewaan.id_lapangan=lapangan.id_lapangan WHERE status='Lunas'"); ?>
                            <?php  
                            // $jml_data = $q->num_rows;
                            $row = $q->fetch_array(); 
                            $total = $row['total'];
                            ?>
                            
                   
                    <tfoot>
                            <td colspan="3" style="text-align: center;"><strong>Total Sewa Lunas</strong></td>
                            <td style="color: black;"><strong>Rp. <?php echo number_format($total); ?>,-</strong></td>
                                              
                    </tfoot>
                    <?php }else { ?>

                      <tr>
                        <td colspan="5" align="center">Pilih Opsi Tampil</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center"><strong>TOTAL</strong></td>
                        <td style="color: red;"><strong>0,-</strong></td>
                      </tr>

                    <?php } ?>


                      


                  </table>
                </div>
                <div class="text-right">
                  <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div> <!-- penel body -->
            </div><!-- panel primary -->
        </div><!-- col -->
        </div><!-- row -->
        
        <!-- container -->
        <!-- </div> -->


</body>
</html>