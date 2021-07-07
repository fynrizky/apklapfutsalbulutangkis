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
            <h1>Data Lapangan <small>Data Lapangan</small></h1>
            <a href="" class="btn btn-secondary pull-right" style="margin-left: 8px;"><i class="fa fa-print"></i> Cetak</a>
            <button type="button" class="btn btn-info pull-right" id="tambahdatalapangan" data-toggle="modal" data-target="#tambahlapangan">
                  <i class="fa fa-plane"></i> Tambah 
            </button>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i>Data Lapangan</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <?php 
        if(@$_GET['hapus']){
          $id = $_GET['hapus'];
          $lapangan->hapus($koneksi,$id);
          echo "<script>alert('data berhasil dihapus');</script>";
          echo "<script>window.location.href='?page=lapangan';</script>";
        }
        ?>
  
  <!-- table -->
  <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book"></i> Data Lapangan</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lapangan</th>
                            <th>Harga Sewa Lapangan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $qry = $lapangan->tampil_lapangan($koneksi);

                      foreach ($qry as $dat => $data) {
                      
                    ?>
                    <tr>
                        <td><?= $dat + 1 ?></td>
                        <td><?= ucwords($data['nama_lapangan']) ?></td>
                        <td>Rp. <?= number_format($data['harga_sewa']) ?>/Jam</td>
                        <td><img src="../assets/img/<?= $data['gambar']; ?>" width="100px"></td>
                        
                        <td>
                            <a id="ubahdatalapangan" data-toggle="modal" data-target="#ubahlapangan" data-idlapangan="<?= $data['id_lapangan'] ?>" data-namalapangan="<?= $data['nama_lapangan'] ?>" data-hargasewa="<?= $data['harga_sewa'] ?>" data-gbr="<?= $data['gambar'] ?>" ><button class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i> Update</button></a>
                            <a href="?page=lapangan&hapus=<?= $data['id_lapangan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Ingin Di Hapus ?')"><i class="fa fa-trash-o"></i>Delete</a>
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
  
  
        <?php include_once 'modalaksi/tambahlapangan.php'; ?>
        <?php include_once 'modalaksi/ubahlapangan.php'; ?>

  </table>
</body>
</html>