<?php 
session_start();
include_once "admin/config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dataTables.min.css">
</head>
<body>
<!-- navbar -->
<section>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <?php if(@$_SESSION['pelanggan']): ?>
  <a class="navbar-brand" href="?page=halutama" style="font-size: 30px;"><strong>ZAZILA SP<img src="assets/img/bolasepak.png" width="25px" height="25px" style="margin-top:-5px; margin-left:2px;" />RT</strong> <sup style="font-size: 12px;">Welcome (<?= ucwords($_SESSION['pelanggan']['nama_pelanggan']); ?>)</sup></a>
  <?php else: ?>
    <a class="navbar-brand" href="?page=halutama" style="font-size: 30px;"><strong>ZAZILA SP<img src="assets/img/bolasepak.png" width="25px" height="25px" style="margin-top:-5px; margin-left:2px;" />RT</strong></a>
  <?php endif; ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
      <a class="nav-item nav-link" href="?page=halutama">Halaman Utama</a>
      <?php if(@$_SESSION['pelanggan']) : ?>
      <?php $tglskrg = date('Y-m-d'); ?>
      <?php if(@$_SESSION['pelanggan']['id_pelanggan'] == 1) : ?>
      <a class="nav-item nav-link" href="?page=daftarpl">Daftar Member</a>
      <?php endif; ?>
      <a class="nav-item nav-link" href="?page=datasewalapangan&tglskrg=<?= $tglskrg; ?>">Data Jadwal Sewa Lapangan</a>
      <a class="nav-item nav-link" href="?logoutpl=2">Logout</a>
      <?php else: ?>
      <a class="nav-item nav-link" href="?page=loginpl">Login Customer</a>
      <?php endif; ?>
    </div>
  </div>
</div>
</nav>
</section>
<!-- end navbar -->

  <?php 
    if(@$_GET['page'] == 'halutama' || @$_GET['page'] == '')
    {
      include_once "halutama.php";
    }
    if(@$_GET['page'] == 'loginpl')
    {
      include_once "loginpl.php";
    }
    if(@$_GET['page'] == 'daftarpl')
    {
      include_once "daftarpl.php";
    }
    if(@$_GET['logoutpl'])
    {
      include_once "logoutpl.php";
    }
    if(@$_GET['page'] == 'pesanlapangan')
    {
      include_once "pesanlapangan.php";
    }
    if(@$_GET['page'] == 'detailpesanlapangan')
    {
      include_once "detailpesanlapangan.php";
    }
    if(@$_GET['page'] == 'datasewalapangan')
    {
      include_once "datasewalapangan.php";
    }

    
  
  ?>

    <script src="bootstrap-4.3.1-dist/js/jquery.js"></script>
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#dataTable').DataTable({
        lengthMenu: [
              [5, 25, 50, -1],
              [5, 25, 50, "All"]
            ]
        });
      });
      </script>
  
</body>
</html>