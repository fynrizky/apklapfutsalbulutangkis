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
            <h1>Laporan Perubahan Jadwal <small> Report</small></h1>
    <div class="row">
		<div class="col-lg-12">
        <form method="post" class="form-inline" style="margin-bottom: 20px;">
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tgl_1" value="<?= date('Y-m-d') ?>" class="form-control" name="tgl_1">
                    </div>
                  </div>
                  <br>
                  <label> Hingga </label>
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tgl_2" value="<?= date('Y-m-d') ?>" class="form-control" name="tgl_2">
                    </div>
                  </div>
                  <br>
                  <div class="col-lg">
                    <div class="form-group">
                            <?php $qry = $koneksi->query("SELECT * FROM lapangan"); ?>
                      <select name="lap" id="lap" class="form-control">
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
                    <button class="btn btn-primary" name="semuaperubahan"><i class="fa fa-list"></i> Semua Data</button>
                  </div>
		        </form>
		</div>
		</div>

                 <?php if (isset($_POST['prosess'])){ ?>
										<a href="?page=cetaklaporanperubahanjadwal&tgl_1=<?= $_POST['tgl_1']; ?>&tgl_2=<?= $_POST['tgl_2']; ?>&lap=<?= $_POST['lap'] ?>" target="_BLANK" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								 <?php } ?>
								<?php if (isset($_POST['semuaperubahan'])){ ?>
										<a href="?page=cetaklaporanperubahanjadwal&semuaperubahan" target="_BLANK" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								<?php } ?>
								<?php if (!isset($_POST['prosess']) && !isset($_POST['semuaperubahan'])){ ?>
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
                <h3 class="panel-title"><i class="fa fa-book"></i> Report</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Penyewaan</th>
                            <th>Jam Berubah</th>
                            <th>Lapangan</th>
                            <th>Status Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    	if (isset($_POST['prosess'])) {
                        // $totalsewa = $laporan->hitung_total_penyewaan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);
                        $cek = $laporanperubahanjadwal->cek_perubahanjadwal_bulan($koneksi,$_POST['tgl_1'],$_POST['tgl_2'],$_POST['lap']);
                        if ($cek === false) {//jika tidak ada datanya
                          false;//tidak tampil atau false
                        }else{
                        $qry = $laporanperubahanjadwal->tampil_laporan_bulan_perubahanjadwal($koneksi,$_POST['tgl_1'],$_POST['tgl_2'],$_POST['lap']);


                    
                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        
                        <td>
                        <?= date('d/m/Y', strtotime($data['tanggal_penyewaan'])); ?>
                        </td>

                        <td>
                        <?= $data['jam_berubah']; ?>
                        </td>
                        
                        <td>
                        <?php $_SESSION['lapangan'] = $data['id_lapangan']; ?>
                        <strong><?= $data['nama_lapangan']; ?></strong>
                        </td>
                      
                        <td>
                        <span class="label label-success" style="font-size: 12px;border-radius:100px;"><?= ucwords($data['status_berubah']); ?></span>
                        </td>
                      
                      
                    </tr>
                    <?php 
                    // $pelanggan = $data['id_pelanggan'];
                    ?>
                    <?php } ?>
                    <?php } ?>
                    
                    <?php } 

                    //JIka tombol semua di pencet 
                    
                    	elseif (isset($_POST['semuaperubahan'])) {
                        // $totalsewa = $laporan->hitung_total_penyewaan_bulan($koneksi,$_POST['tgl1'],$_POST['tgl2'],$_POST['lapangan']);
                        $cek = $laporanperubahanjadwal->cek_perubahanjadwal($koneksi);
                        if ($cek === false) {
                          false;
                        }else{
                        $qry = $laporanperubahanjadwal->tampil_laporan_perubahanjadwal($koneksi);


                    
                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>

                         <td><?= $dat + 1 ?></td>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        
                        <td>
                        <?= date('d/m/Y', strtotime($data['tanggal_penyewaan'])); ?>
                        </td>

                        <td>
                        <?= $data['jam_berubah']; ?>
                        </td>
                        
                        <td>
                        <?php $_SESSION['lapangan'] = $data['id_lapangan']; ?>
                        <strong><?= $data['nama_lapangan']; ?></strong>
                        </td>
                                           
                        
                        <td>
                        <span class="label label-success" style="font-size: 12px;border-radius:100px;"><?= ucwords($data['status_berubah']); ?></span>
                        </td>

                    </tr>
                    <?php 
                    // $pelanggan = $data['id_pelanggan'];
                    ?>
                    <?php } ?>
                    <?php } ?>
                    </tbody>
                         
                            
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