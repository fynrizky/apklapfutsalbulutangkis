<?php
include_once "../../config/koneksi.php";

// $idpenyewaan = $_POST['idtransaksi'];
$idpelanggan = $_POST['idpelanggan'];
$status = $_POST['status'];
$btsdp = "jika lewat dari jam yang telah ditentukan maka DP hilang";
$tgl = $_POST['tgl'];




$koneksi->query("UPDATE penyewaan SET status='$status', batas_waktu_dp='$btsdp' WHERE id_pelanggan = '$idpelanggan' AND tgl_penyewaan = '$tgl'");
echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=transaksi';</script>";
?>