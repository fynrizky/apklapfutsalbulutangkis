<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<!-- <div class="container"> -->
<div class="row">
          <div class="col-lg-12">
            <h1>Data Transaksi <small>Data Transaksi</small></h1>
            <a href="" class="btn btn-secondary pull-right" style="margin-left: 8px;"><i class="fa fa-print"></i> Cetak</a>
            <!-- <button type="button" class="btn btn-info pull-right" id="tambahdatasewa" disabled="disabled" data-toggle="modal" data-target="#tambahsewa">
                  <i class="fa fa-plane"></i> Tambah 
            </button>
             -->
            <!-- <button type="button" class="btn btn-info pull-right" id="tambahdatatransaksi" data-toggle="modal" data-target="#tambahtransaksi">
                  <i class="fa fa-plane"></i> Tambah 
            </button> -->

            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i>Data transaksi</li>
            </ol>
          </div>
        </div><!-- /.row -->
        <!-- container -->
<!-- </div> -->

        <?php 
        if(@$_GET['hapus'] && @$_GET['tgl']){
          $id = $_GET['hapus'];
          $tgl = $_GET['tgl'];
          $transaksi->hapus($koneksi,$id,$tgl);
          echo "<script>alert('data berhasil dihapus');</script>";
          echo "<script>window.location.href='?page=transaksi';</script>";
        }
        // $transaksi->hapusmk($koneksi);
        // echo "<script>alert('data berhasil dihapus');</script>";
        // echo "<script>window.location.href='?page=transaksi';</script>";
        ?>
  
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
                            <th>Pelanggan</th>
                            <th>Deskripsi</th>
                            <th>Total</th>
                            <th>DP</th>
                            <th>Sisa Pelunasan</th>
                            <th>Dibayar</th>
                            <th>Status Sewa</th>
                            <th>Status Lapangan</th>
                            <!-- <th>Batas Waktu DP</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $qry = $transaksi->tampil_transaksi($koneksi);


                    
                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <?php 
                       
                        $potongtgl = explode("/", date('Y/m/d', strtotime($data['tgl_penyewaan'])));
                        $potongbln = explode("-", $data['tgl_penyewaan']);
                        $potongtahun = substr(date('d/m/Y', strtotime($data['tgl_penyewaan'])),-4);
                        $ptgth = substr($potongtahun,2);
                        ?>
                        <?php
                        $idpl = "BOK-". end($potongtgl) . next($potongbln) . $ptgth;
                        $idlapangan = $data['id_lapangan'];
                        $kode = $idpl . $idlapangan . $data['id_pelanggan'];
                        ?>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        <td>
                        <strong style="color: blue;"><?= $kode; ?></strong>
                        <?php $_SESSION['lapangan'] = $data['id_lapangan']; ?>
                        <strong><?= $data['nama_lapangan']; ?></strong>
                        <br>
                        Tgl Penyewaan   :
                        <?= date('d/m/Y', strtotime($data['tgl_penyewaan'])); ?>
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
                        <?php 
                        if($data['status'] != 'Pembayaran DP'){
                          $datdp = "0";
                          $koneksi->query("UPDATE penyewaan SET dp='$datdp' 
                          WHERE id_pelanggan='$data[id_pelanggan]' 
                          AND id_lapangan='$data[id_lapangan]' 
                          AND tgl_penyewaan='$data[tgl_penyewaan]'
                          AND status!='Pembayaran DP' 
                          ");
                          echo "0";
                        }else{
                          
                        
                        $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$_SESSION[lapangan]'"); //session lihat baris 83
                        $rowlapangan = $query->fetch_assoc();
                        $persen = 50/100;
                        $dp = $rowlapangan['harga_sewa'] * $persen;
       
                        $koneksi->query("UPDATE penyewaan SET dp='$dp' 
                          WHERE id_pelanggan='$data[id_pelanggan]' 
                          AND id_lapangan='$data[id_lapangan]' 
                          AND tgl_penyewaan='$data[tgl_penyewaan]'
                          AND status='Pembayaran DP' 
                          ");
                          echo "<strong><span style=color:green;>Rp. ".number_format($dp).",-</span></strong>";
                        }
                        ?>
                        </td>


                        <td>
                        <?php 
                        if($data['status'] != 'Pembayaran DP'){
                          echo "0";
                        }else{
                          
                        
                        $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$_SESSION[lapangan]'"); //session lihat baris 77
                        $rowlap = $query->fetch_assoc();
                        $persen = 50/100;
                        $dp = $rowlap['harga_sewa'] * $persen;
                        $pelunasan = $total - $dp;
                          echo "<strong><span style=color:red;>Rp. ".number_format($pelunasan).",-</span></strong>";
                        }
                        ?>
                        </td>


                        <td>
                        <?php 
                        if($data['status'] != 'Lunas'){
                          $dat = "0";
                          $koneksi->query("UPDATE penyewaan SET dibayar='$dat' 
                          WHERE id_pelanggan='$data[id_pelanggan]' 
                          AND id_lapangan='$data[id_lapangan]' 
                          AND tgl_penyewaan='$data[tgl_penyewaan]'
                          AND status!='Lunas' 
                          ");
                          echo "0";
                        }else{
                          $koneksi->query("UPDATE penyewaan SET dibayar='$data[harga_sewa]' 
                          WHERE id_pelanggan='$data[id_pelanggan]' 
                          AND id_lapangan='$data[id_lapangan]' 
                          AND tgl_penyewaan='$data[tgl_penyewaan]'
                          AND status='Lunas' 
                          ");
                          echo "<strong><span style=color:green;>Rp. ".number_format($total).",-</span></strong>";
                        }
                        ?>
                        </td>
                        
                        
                        <td>
                        <?php echo
                        $data['status'] == 'Menunggu Konfirmasi' ? 
                        '<span class="label label-warning" style="border-radius: 100px; font-size: 12px; ">Menunggu Konfirmasi</span>' : 
                        ($data['status'] == 'Pembayaran DP' ? '<span class="label label-primary" style="border-radius: 100px; font-size: 12px; ">DP</span>' :
                        '<span class="label label-success" style="border-radius: 100px; font-size: 12px; ">Success</span>');
                        ?>
                        </td>
                        
                        <td>
                        <?php echo
                        $data['status'] == 'Menunggu Konfirmasi' ? 
                        '<span class="label label-danger" style="border-radius: 100px; font-size: 12px; ">Bocked</span>' : 
                        ($data['status'] == 'Pembayaran DP' ? '<span class="label label-danger" style="border-radius: 100px; font-size: 12px;">Bocked</span>' : 
                        '<span class="label label-primary" style="border-radius: 100px; font-size: 12px;">Pakai</span>');
                        ?>
                        </td>

                        <!-- <td>
                        
                        <?php //if($data['status'] == 'Menunggu Konfirmasi') : ?>
                        <?php //echo "Pesan Belum Terisi"; ?>
                        <?php //else: ?>
                        <?php //echo $data['batas_waktu_dp']; ?>
                        <?php //endif; ?>
                        </td> -->
                        
                      
                        <td>
                            <!-- <a id="ubahdatatransaksi" data-toggle="modal" data-target="#ubahtransaksi" data-idpelanggan="<?= $data['id_pelanggan']; ?>" data-status="<?= $data['status']; ?>" data-btsdp="<?= $data["batas_waktu_dp"]; ?>" data-tgl="<?= $data['tgl_penyewaan'] ?>" ><button class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i> Update</button></a> -->
                            <a id="ubahdatatransaksi" data-toggle="modal" data-target="#ubahtransaksi" data-idpelanggan="<?= $data['id_pelanggan']; ?>" data-status="<?= $data['status']; ?>" data-tgl="<?= $data['tgl_penyewaan'] ?>" ><button class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i> Update</button></a>
                            <?php if($data['status'] == 'Menunggu Konfirmasi') : ?>
                            <?php $transaksi->hapusmk($koneksi);//hapus menunggu konfirmasi ?>
                            <?php else : ?>
                              <a href="?page=transaksi&hapus=<?= $data['id_pelanggan'] ?>&tgl=<?= $data['tgl_penyewaan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Ingin Di Hapus ?')"><i class="fa fa-trash-o"></i>Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                    // $pelanggan = $data['id_pelanggan'];
                    ?>
                    <?php } ?>
                    </tbody>
                            <?php $q = $koneksi->query("SELECT *, SUM(penyewaan.dibayar) AS total FROM penyewaan 
                            INNER JOIN lapangan ON penyewaan.id_lapangan=lapangan.id_lapangan WHERE status='Lunas'"); ?>
                            <?php  
                            // $jml_data = $q->num_rows;
                            $row = $q->fetch_array(); 
                            $total = $row['total'];
                            ?>
                            
                   
                    <tfoot>
                            <td colspan="6" style="text-align: center;"><strong>Total Sewa Lunas</strong></td>
                            <td style="color: black;"><strong>Rp. <?php echo number_format($total); ?>,-</strong></td>
                                              
                    </tfoot>

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

        <?php //include_once 'modalaksi/tambahjadwalsewa.php'; ?>
        <?php include_once 'modalaksi/ubahtransaksi.php'; ?>

</body>
</html>