<?php 
session_start();
include_once "classcrud/classcrud.php";

if (!isset($_SESSION['adm'])) 
{
	echo "<script>alert('Anda Harus Login..!');</script>";  
	echo "<script>location='loginadmin/loginadmin.php';</script>";
	exit();
		  //header('location:login/login.php');
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blank Page - SB Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dataTables/datatables.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?page=dashboard"><?= ucwords($_SESSION['adm']['username']); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
          <?php if(@$_SESSION['admin']) : ?>
            <li <?= @$_GET['page'] == 'dashboard' ? 'class="active"' : ''; ?>><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li <?= @$_GET['page'] == 'users' ? 'class="active"' : ''; ?> ><a href="?page=users"><i class="fa fa-user"></i> Users</a></li>
            <li <?= @$_GET['page'] == 'lapangan' ? 'class="active"' : ''; ?> ><a href="?page=lapangan"><i class="fa fa-list"></i> Lapangan</a></li>
            <!-- <li <?= @$_GET['page'] == 'waktu' ? 'class="active"' : ''; ?> ><a href="?page=waktu"><i class="fa fa-gear"></i> Waktu</a></li> -->
            <li <?= @$_GET['page'] == 'jadwalsewa' ? 'class="active"' : ''; ?> ><a href="?page=jadwalsewa"><i class="fa fa-clock-o"></i> Jadwal Sewa</a></li>
            <li <?= @$_GET['page'] == 'customer' ? 'class="active"' : ''; ?> ><a href="?page=customer"><i class="fa fa-users"></i> Pelanggan</a></li>
            <li <?= @$_GET['page'] == 'transaksi' ? 'class="active"' : ''; ?> ><a href="?page=transaksi"><i class="fa fa-money"></i> Transaksi</a></li>
            <li <?= @$_GET['page'] == 'perubahanjadwal' ? 'class="active"' : ''; ?> ><a href="?page=perubahanjadwal"><i class="fa fa-plane"></i> Perubahan Jadwal</a></li>
            <li <?= @$_GET['page'] == 'laporansewa' ? 'class="active"' : ''; ?> ><a href="?page=laporansewa"><i class="fa fa-folder"></i> Laporan Penyewaan</a></li>
            <li <?= @$_GET['page'] == 'laporanbtsdp' ? 'class="active"' : ''; ?> ><a href="?page=laporanbtsdp"><i class="fa fa-folder"></i> Laporan Batas Waktu DP</a></li>
            <li <?= @$_GET['page'] == 'laporanperubahanjadwal' ? 'class="active"' : ''; ?> ><a href="?page=laporanperubahanjadwal"><i class="fa fa-folder"></i> Laporan Perubahan Jadwal</a></li>
            <?php elseif(@$_SESSION['pimpinan']): ?>
              <li <?= @$_GET['page'] == 'dashboard' ? 'class="active"' : ''; ?>><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li <?= @$_GET['page'] == 'laporansewa' ? 'class="active"' : ''; ?> ><a href="?page=laporansewa"><i class="fa fa-folder"></i> Laporan Penyewaan</a></li>
              <li <?= @$_GET['page'] == 'laporanbtsdp' ? 'class="active"' : ''; ?> ><a href="?page=laporanbtsdp"><i class="fa fa-folder"></i> Laporan Batas Waktu DP</a></li>
              <li <?= @$_GET['page'] == 'laporanperubahanjadwal' ? 'class="active"' : ''; ?> ><a href="?page=laporanperubahanjadwal"><i class="fa fa-folder"></i> Laporan Perubahan Jadwal</a></li>
          <?php endif; ?>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
           
            <!-- <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li> -->
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= ucwords($_SESSION['adm']['namauser']); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="loginadmin/proseslogin.php?logout=1"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

       <!-- disini -->
       <?php 
        if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '')
        {
          include_once "views/dashboard.php";
        }
        if(@$_GET['page'] == 'users')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/users.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php"; 
          }
        }
        if(@$_GET['page'] == 'customer')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/pelanggan.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php";        
          }
        }
        if(@$_GET['page'] == 'lapangan')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/lapangan.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php";        
          }
        }
        if(@$_GET['page'] == 'jadwalsewa')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/jadwalsewa.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php";        
          }
        }
        if(@$_GET['page'] == 'transaksi')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/transaksipenyewaan.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php";        
          }
        }
        if(@$_GET['page'] == 'perubahanjadwal')
        {
          if(@$_SESSION['admin'])
          {
            include_once "views/perubahanjadwal.php";
          }else{
            echo "<script>alert('maaf tidak diizinkan akses ke menu ini');</script>";
            include_once "views/dashboard.php";        
          }
        }
        //lap sewa
        if(@$_GET['page'] == 'laporansewa')
        {
          include_once "views/laporanpenyewaan.php";
        }
        if(@$_GET['page'] == 'cetaklaporan' || @$_GET['tgl1'] || @$_GET['tgl2'] || @$_GET['lapangan'] || @$_GET['semua'])
        {
          include_once "views/cetaklaporan.php";
        }
        //lap bts dp
        if(@$_GET['page'] == 'laporanbtsdp')
        {
          include_once "views/laporanbatasdp.php";
        }
        if(@$_GET['page'] == 'cetaklaporanbtsdp' || @$_GET['tanggal_1'] || @$_GET['tanggal_2'])
        {
          include_once "views/cetaklaporanbtsdp.php";
        }
        
        //lap perubahan jdwl
        if(@$_GET['page'] == 'laporanperubahanjadwal')
        {
          include_once "views/laporanperubahanjadwal.php";
        }
        if(@$_GET['page'] == 'cetaklaporanperubahanjadwal' || @$_GET['tgl_1'] || @$_GET['tgl_2'] || @$_GET['lap'] || @$_GET['semuaperubahan'])
        {
          include_once "views/cetaklaporanperubahanjadwal.php";
        }
        // if(@$_GET['page'] == 'cetaklaporan' || @$_GET['tgl1'] || @$_GET['tgl2'] || @$_GET['lapangan'] || @$_GET['semua'])
        // {
        //   include_once "views/cetaklaporan.php";
        // }
       ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../dataTables/datatables.min.js"></script>
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
      <script src="../myjquery/jqueryku.js"></script>

  </body>
</html>