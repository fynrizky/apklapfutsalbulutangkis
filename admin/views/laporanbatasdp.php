<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row">
          <div class="col-lg-12">
            <h1>Laporan Batas Waktu DP <small>Laporan Batas Waktu DP</small></h1>
            <div class="row">
		<div class="col-lg-12">
        <form method="post" class="form-inline" style="margin-bottom: 20px;">
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tanggal_1" value="<?= date('Y-m-d') ?>" class="form-control" name="tanggal_1">
                    </div>
                  </div>
                  <br>
                  <label> Hingga </label>
                  <div class="col-lg">
                    <div class="form-group">
                      <input type="date" id="tanggal_2" value="<?= date('Y-m-d') ?>" class="form-control" name="tanggal_2">
                    </div>
                  </div>
                  <!-- <br> -->
                  <!-- <div class="col-lg">
                    <div class="form-group">
                            <?php $qry = $koneksi->query("SELECT * FROM lapangan"); ?>
                      <select name="lap" id="lap" class="form-control">
                                    <option value="">--PILIH LAPANGAN--</option>
                            <?php while($data = $qry->fetch_array()){  ?>
                                    <option value="<?=$data['id_lapangan']?>"><?= $data['nama_lapangan'] ?></option>
                            <?php } ?>
                                </select>
                    </div>
                  </div> -->
                  <hr/>
                  <div class="form-group">
                    <button type="submit" id="formbtn" name="prosess" class="btn btn-default"><i class="fa fa-play-circle"></i> Prosess</button>
                    <!-- <button class="btn btn-primary" name="semuaperubahan"><i class="fa fa-list"></i> Semua Data</button> -->
                  </div>
		        </form>
		</div>
		</div>

                <?php if (isset($_POST['prosess'])){ ?>
										<a href="?page=cetaklaporanbtsdp&tanggal_1=<?= $_POST['tanggal_1']; ?>&tanggal_2=<?= $_POST['tanggal_2']; ?>" target="_BLANK" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								 
                <?php }else{ ?>
										<!-- <a href="#" class="btn btn-info btn-sm pull-right" disabled="disabled"><i class="fa fa-print"></i> Cetak</a> -->
										<a href="?page=cetaklaporanbtsdp" class="btn btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</a>
								<?php } ?>
            <!-- <a href="?page=cetaklaporanbtsdp" class="btn btn-secondary pull-right" style="margin-left: 8px;"><i class="fa fa-print"></i> Cetak</a> -->
            <!-- <button type="button" class="btn btn-info pull-right" id="tambahdatapelanggan" data-toggle="modal" data-target="#tambahpelanggan">
                  <i class="fa fa-plane"></i> Tambah 
            </button> -->
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i>Laporan Batas Waktu DP</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <?php 
        // if(@$_GET['hapus']){
        //   $id = $_GET['hapus'];
        //   $pelanggan->hapus($koneksi,$id);
        //   echo "<script>alert('data berhasil dihapus');</script>";
        //   echo "<script>window.location.href='?page=customer';</script>";
        // }
        ?>
  
  <!-- table -->
  <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book"></i> Laporan Batas Waktu DP</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Penyewaan</th>
                            <th>Nama Pelanggan / Member</th>
                            <th>DP</th>
                            <th>Deskripsi Pesan</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                      if(isset($_POST['prosess'])){
                      $cek = $laporanbtsdp->ceklaporanbtsdp($koneksi,$_POST['tanggal_1'],$_POST['tanggal_2']);
                      if($cek === false){
                        false;
                      }else{
                        $qry = $laporanbtsdp->tampil_bln_lapbtsdp($koneksi,$_POST['tanggal_1'],$_POST['tanggal_2']);
                        $sumprosess=0;
                        $no=1;
                      while ($data = $qry->fetch_assoc()) {
                        $value = $data['dp'];
                      $sumprosess+=$value;
                      ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= ucwords($data['tgl_penyewaan']); ?></td>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        <td>
                        <?php 
                        if($data['status'] != 'Pembayaran DP'){
                          echo "0";
                        }else{
                            
                          
                          
                          // $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$data[id_lapangan]'"); //session lihat baris 83
                          // $rowlapangan = $query->fetch_assoc();
                          // $persen = 50/100;
                          // $dp = $rowlapangan['harga_sewa'] * $persen;
                          
                          
                          
                          // echo "<strong><span style=color:green;>Rp. ".number_format($dp).",-</span></strong>";
                          echo "<strong><span style=color:green;>Rp. ".number_format($value).",-</span></strong>";
                        }
                        ?>      
                        </td>

                        <td><?= ucwords($data['batas_waktu_dp']); ?></td>
                        
                       
                    </tr>
                    <?php } ?>
                    </tbody>
                      
                      <tfoot>
                            <td colspan="3" style="text-align: center;"><strong>Total DP Masuk</strong></td>
                            <td style="color: black;"><strong>Rp. <?php echo  number_format($sumprosess); ?>,-</strong></td>
                      </tfoot>
                        
                    <?php } ?>
                    <?php }else{ ?>

                      <?php
                      $qry = $laporanbtsdp->tampil_lapbtsdp($koneksi);
                        $sum=0;
                        $no=1;
                      while ($data = $qry->fetch_assoc()) {
                        $value = $data['dp'];
                      $sum+=$value;
                      ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= ucwords($data['tgl_penyewaan']); ?></td>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        <td>
                        <?php 
                        if($data['status'] != 'Pembayaran DP'){
                          echo "0";
                        }else{
                            
                          
                          
                          // $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$data[id_lapangan]'"); //session lihat baris 83
                          // $rowlapangan = $query->fetch_assoc();
                          // $persen = 50/100;
                          // $dp = $rowlapangan['harga_sewa'] * $persen;
                          
                          
                          
                          // echo "<strong><span style=color:green;>Rp. ".number_format($dp).",-</span></strong>";
                          echo "<strong><span style=color:green;>Rp. ".number_format($value).",-</span></strong>";
                        }
                        ?>      
                        </td>

                        <td><?= ucwords($data['batas_waktu_dp']); ?></td>
                        
                       
                    </tr>
                    <?php } ?>

                   
                    </tbody>
      
                    <tfoot>
                            <td colspan="3" style="text-align: center;"><strong>Total DP Masuk</strong></td>
                            <td style="color: black;"><strong>Rp. <?php echo  number_format($sum); ?>,-</strong></td>
                    </tfoot>
                   <?php } ?>                    
                    

                  </table>
                </div>
                <div class="text-right">
                  <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- row -->
    
</body>
</html>