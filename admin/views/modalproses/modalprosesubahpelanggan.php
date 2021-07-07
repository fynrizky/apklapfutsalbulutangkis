<?php
include_once "../../config/koneksi.php";

$idpl = $_POST['idpl'];
$emailpl = $koneksi->real_escape_string($_POST['emailpl']);
$namapl = $koneksi->real_escape_string($_POST['namapl']);
$passwordpl = $koneksi->real_escape_string($_POST['passwordpl']);
$passwordpl2 = $koneksi->real_escape_string($_POST['passwordpl2']);
$notelppl = $koneksi->real_escape_string($_POST['notelppl']);

 //cek password
 if ($passwordpl2 != $passwordpl) {
    echo "<script>alert('Password Tidak Sama Silahkan Coba Lagi !');</script>";
    echo "<script>window.location.href='?page=customer';</script>";
    return false;
}

 //buat query baru
 $query = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$idpl'");

 //jika password tidak diisi/diganti
 if (empty($passwordpl)) {
     $row = $query->fetch_assoc();
     $passwordpl = $row['password_pelanggan'];
 } else { // dan kalau diisi/diganti
     $passwordpl = $passwordpl;
 }

$koneksi->query("UPDATE pelanggan SET email_pelanggan='$emailpl', nama_pelanggan='$namapl', password_pelanggan='$passwordpl', notelp='$notelppl' WHERE id_pelanggan = '$idpl' ");
echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=customer';</script>";
?>