<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Dashboard</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i> Blank Page</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <div class="row">

        <?php 
        $qry = $koneksi->query("SELECT * FROM pelanggan");
        $jdata = $qry->num_rows;
        $data = $qry->fetch_array();
        ?>
          <div class="col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?= $jdata; ?></p>
                    <p class="announcement-text"><?= "Pelanggan" ?></p>
                  </div>
                </div>
              </div>
              <a href="?page=transaksi">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Mentions
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        <?php 
        
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.status, penyewaan.tgl_penyewaan, penyewaan.id_pelanggan, penyewaan.id_lapangan
        FROM penyewaan INNER JOIN pelanggan
        ON penyewaan.id_pelanggan = pelanggan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
        WHERE penyewaan.status='Menunggu Konfirmasi'");
        $jdata = $qry->num_rows;
        $data = $qry->fetch_array();
        ?>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-5">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-7 text-right">
                    <p class="announcement-heading"><?= $jdata; ?></p>
                    <p class="announcement-text"><?= 'Menunggu Konfirmasi' ?></p>
                  </div>
                </div>
              </div>
              <a href="?page=transaksi">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Mentions
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <?php 
        
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.status, penyewaan.tgl_penyewaan, penyewaan.id_pelanggan, penyewaan.id_lapangan
        FROM penyewaan INNER JOIN pelanggan
        ON penyewaan.id_pelanggan = pelanggan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
        WHERE penyewaan.status='Pembayaran DP'");
        $jdata = $qry->num_rows;
        $data = $qry->fetch_array();
        ?>
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?= $jdata; ?></p>
                    <p class="announcement-text"><?= "DP/Uang Muka" ?></p>
                  </div>
                </div>
              </div>
              <a href="?page=transaksi">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Mentions
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <?php 
          
          $qry = $koneksi->query("SELECT DISTINCT penyewaan.status, penyewaan.tgl_penyewaan, penyewaan.id_pelanggan, penyewaan.id_lapangan
          FROM penyewaan INNER JOIN pelanggan
          ON penyewaan.id_pelanggan = pelanggan.id_pelanggan
          INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
          INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
          WHERE penyewaan.status='Lunas'");
          $jdata = $qry->num_rows;
          $data = $qry->fetch_array();
          ?>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?= $jdata; ?></p>
                    <p class="announcement-text"><?= "Lunas" ?></p>
                  </div>
                </div>
              </div>
              <a href="?page=transaksi">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      View Mentions
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>


          <?php 
          $qry = $koneksi->query("SELECT * FROM perubahan_jadwal");
          $jdata = $qry->num_rows;
          $data = $qry->fetch_array();
          ?>
            <div class="col-lg-3">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-5">
                      <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-7 text-right">
                      <p class="announcement-heading"><?= $jdata; ?></p>
                      <p class="announcement-text"><?= "Perubahan Jadwal" ?></p>
                    </div>
                  </div>
                </div>
                <a href="?page=perubahanjadwal">
                  <div class="panel-footer announcement-bottom">
                    <div class="row">
                      <div class="col-xs-6">
                        View Mentions
                      </div>
                      <div class="col-xs-6 text-right">
                        <i class="fa fa-arrow-circle-right"></i>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>


        
        </div><!-- /row -->
</body>
</html>