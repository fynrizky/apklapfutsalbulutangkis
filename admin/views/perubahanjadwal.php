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
            <h1>Perubahan Jadwal <small>Perubahan Jadwal</small></h1>
            <a href="" class="btn btn-secondary pull-right" style="margin-left: 8px;"><i class="fa fa-print"></i> Cetak</a>
            <button type="button" class="btn btn-info pull-right" id="tambahperubahanjadwal" data-toggle="modal" data-target="#tambahperubahan">
                  <i class="fa fa-plane"></i> Tambah 
            </button>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i>Perubahan Jadwal</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <?php 
        if(@$_GET['hapus']){
          $id = $_GET['hapus'];
          $perubahanjadwal->hapus($koneksi,$id);
          echo "<script>alert('data berhasil dihapus');</script>";
          echo "<script>window.location.href='?page=perubahanjadwal';</script>";
        }
        ?>
  
  <!-- table -->
  <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book"></i> Perubahan Jadwal</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Lapangan</th>
                            <th>Jam Berubah</th>
                            <th>Tanggal Penyewaan</th>
                            <th>Status Perubahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $qry = $perubahanjadwal->tampil_perubahan_jadwal($koneksi);

                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <td><?= ucwords($data['nama_pelanggan']); ?></td>
                        <td><?= ucwords($data['nama_lapangan']); ?></td>
                        <td><?= ucwords($data['jam_berubah']); ?></td>
                        <td><?= date('d/m/Y', strtotime($data['tanggal_penyewaan'])); ?></td>
                        <td><span class="label label-success" style="font-size: 12px;border-radius:100px;"><?= ucwords($data['status_berubah']); ?></span></td>
                        
                        <td>
                            <a id="ubahdataperubahanjadwal" data-toggle="modal" data-target="#ubahperubahan" data-idperubahan="<?= $data['id_perubahan'] ?>" data-pelanggan="<?= $data['id_pelanggan'] ?>" data-lapangan="<?= $data['id_lapangan'] ?>" data-jamberubah="<?= $data['jam_berubah'] ?>" ><button class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i> Update</button></a>
                            <a href="?page=perubahanjadwal&hapus=<?= $data['id_perubahan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Ingin Di Hapus ?')"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="text-right">
                  <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- row -->
  
  
        <?php include_once 'modalaksi/tambahperubahanjadwal.php'; ?>
        <?php include_once 'modalaksi/ubahperubahanjadwal.php'; ?>

  </table>
</body>
</html>