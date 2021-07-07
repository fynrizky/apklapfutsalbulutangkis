<?php 
include_once "config/koneksi.php";
?>

<?php 
class Users {
    public function tampil_user($koneksi){

        $qry = $koneksi->query("SELECT * FROM users ORDER BY id_user ASC");
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 
    public function hapus($koneksi, $id){
        $koneksi->query("DELETE FROM users WHERE id_user = '$id'");
    }
} 
class Lapangan {
    public function tampil_lapangan($koneksi){

        $qry = $koneksi->query("SELECT * FROM lapangan ORDER BY id_lapangan ASC");
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 
    public function simpan_lapangan($koneksi, $namalapangan, $hargasewa, $gambar){
        $koneksi->query("INSERT INTO lapangan(nama_lapangan, harga_sewa, gambar)
        VALUES('$namalapangan','$hargasewa','$gambar')");
    }
    public function hapus($koneksi, $id){
        $koneksi->query("DELETE FROM lapangan WHERE id_lapangan = '$id'");
    }
} 

class Jadwalsewa {
    public function tampil_sewa($koneksi){

        $qry = $koneksi->query("SELECT * FROM jadwal_sewa ORDER BY id_jadwal_sewa");
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 
    public function simpan_sewa($koneksi, $jamsewa){
        $koneksi->query("INSERT INTO jadwal_sewa(jam_sewa)
        VALUES('$jamsewa')");
    }
    public function hapus($koneksi, $id){
        $koneksi->query("DELETE FROM jadwal_sewa WHERE id_jadwal_sewa = '$id'");
    }
} 
class Pelanggan {
    public function tampil_pelanggan($koneksi){

        $qry = $koneksi->query("SELECT * FROM pelanggan ORDER BY id_pelanggan");
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 

    public function simpan_pelanggan($koneksi,$emailpl,$namapl,$notelppl,$passwordpl){
        $koneksi->query("INSERT INTO pelanggan(email_pelanggan,nama_pelanggan,password_pelanggan,notelp) 
        VALUES('$emailpl','$namapl','$passwordpl','$notelppl')");
    }
    
    public function hapus($koneksi, $id){
        $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id'");
    }
}  
class Transaksi {
    public function tampil_transaksi($koneksi){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, 
        penyewaan.tgl_penyewaan, penyewaan.status, penyewaan.batas_waktu_dp FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa ORDER BY penyewaan.id_penyewaan DESC");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 
    
    public function hapusmk($koneksi){

        $koneksi->query("DELETE FROM penyewaan WHERE tgl_pemesanan < DATE_SUB(NOW(), INTERVAL 1 DAY) AND status = 'Menunggu Konfirmasi'");
    }
    public function hapus($koneksi, $hapus, $tgl){
       
        $koneksi->query("DELETE FROM penyewaan WHERE id_pelanggan='$hapus' AND tgl_penyewaan='$tgl'");
    }
} 
class Perubahanjadwal {
    public function tampil_perubahan_jadwal($koneksi){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT * FROM perubahan_jadwal
        INNER JOIN pelanggan ON perubahan_jadwal.id_pelanggan = pelanggan.id_pelanggan
        INNER JOIN lapangan ON perubahan_jadwal.id_lapangan = lapangan.id_lapangan 
        WHERE status_berubah='Jadwal Berubah'");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    }
    
    public function simpan_perubahan_jadwal($koneksi,$pelanggan,$lapangan,$jamberubah,$tgl,$statusperubahan){
        $koneksi->query("INSERT INTO perubahan_jadwal(id_pelanggan,id_lapangan,jam_berubah,tanggal_penyewaan,status_berubah) 
        VALUES('$pelanggan','$lapangan','$jamberubah','$tgl','$statusperubahan')");
    }
    
    public function hapus($koneksi, $id){
        $koneksi->query("DELETE FROM perubahan_jadwal WHERE id_perubahan = '$id'");
    }
} 

class Laporan {
    public function tampil_laporan_bulan($koneksi, $tgl1, $tgl2, $lapangan){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
        WHERE penyewaan.id_lapangan='$lapangan' AND penyewaan.status='Lunas' AND penyewaan.tgl_penyewaan BETWEEN '$tgl1' AND '$tgl2' ORDER BY penyewaan.id_penyewaan DESC");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 
    public function tampil_laporan($koneksi){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, 
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
        WHERE penyewaan.status='Lunas' ORDER BY penyewaan.id_penyewaan DESC");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    } 


    public function cek_penyewaan_bulan($koneksi, $tgl1, $tgl2, $lapangan)
    {
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
        WHERE penyewaan.id_lapangan='$lapangan' AND penyewaan.status='Lunas' AND penyewaan.tgl_penyewaan BETWEEN '$tgl1' AND '$tgl2' ORDER BY penyewaan.id_penyewaan DESC");
         $hitung = $qry->num_rows;
         if ($hitung >= 1) {
             return true;
         } else {
             return false;
         }
    }

    public function cek_penyewaan($koneksi)
    {
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa 
        WHERE penyewaan.status='Lunas' ORDER BY penyewaan.id_penyewaan DESC");
         $hitung = $qry->num_rows;
         if ($hitung >= 1) {
             return true;
         } else {
             return false;
         }
    }
} 

class Laporanbtsdp {
    public function ceklaporanbtsdp($koneksi,$tgl_1,$tgl_2){
        
        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.dp,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, penyewaan.id_lapangan, 
        lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status, penyewaan.batas_waktu_dp FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
        WHERE penyewaan.status='Pembayaran DP' AND penyewaan.tgl_penyewaan BETWEEN '$tgl_1' AND '$tgl_2' ORDER BY penyewaan.id_penyewaan DESC");
        $hitung = $qry->num_rows;
        if ($hitung >= 1) {
            return true;
        } else {
            return false;
        }
    }
    public function tampil_bln_lapbtsdp($koneksi,$tgl_1,$tgl_2){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.dp,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, penyewaan.id_lapangan, 
        lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status, penyewaan.batas_waktu_dp FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
        WHERE penyewaan.status='Pembayaran DP' AND penyewaan.tgl_penyewaan BETWEEN '$tgl_1' AND '$tgl_2' ORDER BY penyewaan.id_penyewaan DESC");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    }
    
    public function tampil_lapbtsdp($koneksi){

        // $qry = $koneksi->query("SELECT * FROM penyewaan");
        // $data = $qry->fetch_object();
        // $pelanggan = $data->id_pelanggan;

        $qry = $koneksi->query("SELECT DISTINCT penyewaan.id_pelanggan, penyewaan.dp,
        lapangan.harga_sewa, pelanggan.nama_pelanggan, lapangan.id_lapangan, penyewaan.id_lapangan, 
        lapangan.nama_lapangan, penyewaan.tgl_penyewaan, penyewaan.status, penyewaan.batas_waktu_dp FROM pelanggan 
        INNER JOIN penyewaan ON pelanggan.id_pelanggan = penyewaan.id_pelanggan
        INNER JOIN lapangan ON penyewaan.id_lapangan = lapangan.id_lapangan
        INNER JOIN jadwal_sewa ON penyewaan.id_jadwal_sewa = jadwal_sewa.id_jadwal_sewa
        WHERE penyewaan.status='Pembayaran DP' ORDER BY penyewaan.id_penyewaan DESC");
        /* Distinct adalah fungsi untuk menampilkan hanya 1 data yang datanya sama atau mirip */
        return $qry;
        if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    }
}

class Laporanperubahanjadwal {
    public function cek_perubahanjadwal_bulan($koneksi, $tgl_1, $tgl_2, $lap)
    {
        $qry = $koneksi->query("SELECT * FROM perubahan_jadwal
        INNER JOIN pelanggan ON perubahan_jadwal.id_pelanggan = pelanggan.id_pelanggan 
        INNER JOIN lapangan ON perubahan_jadwal.id_lapangan = lapangan.id_lapangan
        WHERE perubahan_jadwal.id_lapangan='$lap' AND perubahan_jadwal.status_berubah='Jadwal Berubah' 
        AND perubahan_jadwal.tanggal_penyewaan BETWEEN '$tgl_1' AND '$tgl_2' ORDER BY perubahan_jadwal.id_perubahan DESC");
         $hitung = $qry->num_rows;
         if ($hitung >= 1) {
             return true;
         } else {
             return false;
         }
    }
    public function cek_perubahanjadwal($koneksi)
    {
        $qry = $koneksi->query("SELECT * FROM perubahan_jadwal
        INNER JOIN pelanggan ON perubahan_jadwal.id_pelanggan = pelanggan.id_pelanggan 
        INNER JOIN lapangan ON perubahan_jadwal.id_lapangan = lapangan.id_lapangan
        WHERE perubahan_jadwal.status_berubah='Jadwal Berubah' ORDER BY perubahan_jadwal.id_perubahan DESC");
         $hitung = $qry->num_rows;
         if ($hitung >= 1) {
             return true;
         } else {
             return false;
         }
    }
    public function tampil_laporan_bulan_perubahanjadwal($koneksi, $tgl_1, $tgl_2, $lap)
    {
        $qry = $koneksi->query("SELECT * FROM perubahan_jadwal
        INNER JOIN pelanggan ON perubahan_jadwal.id_pelanggan = pelanggan.id_pelanggan 
        INNER JOIN lapangan ON perubahan_jadwal.id_lapangan = lapangan.id_lapangan
        WHERE perubahan_jadwal.id_lapangan='$lap' AND perubahan_jadwal.status_berubah='Jadwal Berubah' 
        AND perubahan_jadwal.tanggal_penyewaan BETWEEN '$tgl_1' AND '$tgl_2' ORDER BY perubahan_jadwal.id_perubahan DESC");
         return $qry;
         if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;

    }
    public function tampil_laporan_perubahanjadwal($koneksi)
    {
        $qry = $koneksi->query("SELECT * FROM perubahan_jadwal
        INNER JOIN pelanggan ON perubahan_jadwal.id_pelanggan = pelanggan.id_pelanggan 
        INNER JOIN lapangan ON perubahan_jadwal.id_lapangan = lapangan.id_lapangan
        WHERE perubahan_jadwal.status_berubah='Jadwal Berubah' ORDER BY perubahan_jadwal.id_perubahan DESC");
         return $qry;
         if($pecah = $qry->fetch_assoc()){
            $data[] = $pecah;
        }
        return $data;
    
    }
}

$users = new Users();
$lapangan = new Lapangan();
$jadwalsewa = new Jadwalsewa();
$pelanggan = new Pelanggan();
$transaksi = new Transaksi();
$perubahanjadwal = new Perubahanjadwal();
$laporan = new Laporan();
$laporanbtsdp = new Laporanbtsdp();
$laporanperubahanjadwal = new Laporanperubahanjadwal();

?>