<?php
include_once "../../config/koneksi.php";

// $idpenyewaan = $_POST['idtransaksi'];
$idperubahan = $_POST['idperubahan'];
$pl = $_POST['pl'];
$lapangan = $_POST['lapangan'];
$jamberubah = $_POST['jamberubah'];




$koneksi->query("UPDATE perubahan_jadwal SET id_pelanggan='$pl', id_lapangan='$lapangan', jam_berubah='$jamberubah' WHERE id_perubahan = '$idperubahan'");
echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=perubahanjadwal';</script>";
?>