<?php
include_once "../../config/koneksi.php";

$idlapangan = $_POST['idlapangan'];
$namalapangan = $koneksi->real_escape_string($_POST['namalapangan']);
$hargasewa = $koneksi->real_escape_string($_POST['hargasewa']);

$pict = $_FILES['gambar']['name'];
$extensi = explode(".", $_FILES['gambar']['name']);
$gambar = "gbr-".round(microtime(true)).".".end($extensi);
$sumber = $_FILES['gambar']['tmp_name'];

if($pict == ''){

    $koneksi->query("UPDATE lapangan SET nama_lapangan='$namalapangan', harga_sewa='$hargasewa' WHERE id_lapangan=".$idlapangan);
    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script>window.location.href='?page=lapangan';</script>";

}else{
        $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$idlapangan'");
        $data = $query->fetch_assoc();
        $gbr_awal = $data['gambar'];
        unlink("../../../assets/img/".$gbr_awal);
        $upload = move_uploaded_file($sumber, "../../../assets/img/".$gambar);

        if($upload){    
            $koneksi->query("UPDATE lapangan SET nama_lapangan='$namalapangan', harga_sewa='$hargasewa', gambar='$gambar' WHERE id_lapangan = '$idlapangan' ");
            echo "<script>alert('Data Berhasil Di Ubah');window.location.href='?page=lapangan';</script>";
        }else{
            echo "<script>alert('Data Gagal Di Ubah');window.location.href='?page=lapangan';</script>";
        }

}
?>