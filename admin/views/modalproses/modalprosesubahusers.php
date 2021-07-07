<?php
include_once "../../config/koneksi.php";

$idusers = $_POST['idusers'];
$namausers = $koneksi->real_escape_string($_POST['namausers']);




$koneksi->query("UPDATE users SET nama_user='$namausers' WHERE id_user = '$idusers' ");
echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=users';</script>";
?>