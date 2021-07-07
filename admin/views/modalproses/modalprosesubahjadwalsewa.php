<?php
include_once "../../config/koneksi.php";

$idjadwalsewa = $_POST['idjadwalsewa'];
$jamsewa = $koneksi->real_escape_string($_POST['jamsewa']);




$koneksi->query("UPDATE jadwal_sewa SET jam_sewa='$jamsewa' WHERE id_jadwal_sewa = '$idjadwalsewa' ");
echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=jadwalsewa';</script>";
?>