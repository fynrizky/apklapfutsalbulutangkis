<style type="text/css">
*{
font-family: Arial;
font-size: 12px;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
.container{
	margin-top: 10px;
	width: 780px;
	margin-left: auto;
	margin-right: auto;
}
table.grid{
width:20.4cm ;
font-size: 9pt;
border-collapse:collapse;
}
table.grid th{
padding-top:1mm;
padding-bottom:1mm;
}
table.grid th{
background: #F0F0F0;
border: 0.2mm solid #000;
text-align:center;
padding-left:0.2cm;
}
table.grid tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-left:2mm;
border:0.2mm solid #000;
}
h1{
font-size: 18pt;
}
h2{
font-size: 14pt;
}
h3{
font-size: 10pt;
}
.header{
display: block;
width:20.4cm ;
margin-bottom: 0.3cm;
text-align: center;
margin-top: 10px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20cm ;
}
.page {
font-size:13px;
padding-top: 20px;
}
.footer{
	padding-top: 20px;
	margin-left: 600px;
}
</style>
<?php
error_reporting(0);
include 'classcrud.php';
// $perusahaan = new Perusahaan();
if (isset($_GET['tanggal_1']) && isset($_GET['tanggal_2'])) {
	$dat = $laporanbtsdp->tampil_bln_lapbtsdp($koneksi,$_GET['tanggal_1'],$_GET['tanggal_2']);
}else{
	$dat = $laporanbtsdp->tampil_lapbtsdp($koneksi);
}
// $per = $perusahaan->tampil_perusahaan($koneksi);
// $namaper = $per['nama_perusahaan'];
// $alamat = $per['alamat'];
// $pemilik = $per['pemilik'];
// $kota = $per['kota'];
$judul_H = "CETAK LAPORAN BATAS WAKTU DP <br>";
$tgl = date('d-m-Y');
function myheader($judul_H){
echo  "<div class='header' align='center'>
					<h1 align='left'>".'ZAZILA SPORT'."</h1>
		  		<h2>".$judul_H."</h2>
		  	</div>
		<table class='grid' align='center'>
		<tr>
			<th width='3%'>No</th>
			<th>Tanggal Penyewaan</th>
            <th>Nama Pelanggan / Member</th>
            <th>DP</th>
            <th>Deskripsi Pesan</th>
		</tr>";		
}
function myfooter(){
	echo "</table>";
}
	echo "<div class='container' align='center'>"; //center
	$page =1;

	
	foreach ($dat as $index => $data) {
		$no = $index + 1;
		$value = $data['dp'];
		$sum+=$value;

		if(($no % 25) == 1){
		   	if($index + 1 > 1){
		        myfooter();
		        echo "<div class='pagebreak'>
				<div class='page' align='center'>Hal - $page</div>
				</div>";
				$page++;
		  	}
		   	myheader($judul_H);
		}
        $tgl_penyewaan = date_format(date_create($data['tgl_penyewaan']),'d-m-Y');
        
        if($data['status'] != 'Pembayaran DP'){
            echo "0";
          }else{
              
              
        //   $query = $koneksi->query("SELECT * FROM lapangan WHERE id_lapangan = '$_SESSION[lapangan]'"); //session lihat baris 83
        //   $rowlapangan = $query->fetch_assoc();
        //   $persen = 50/100;
		//   $dp = $rowlapangan['harga_sewa'] * $persen;
		$value;

          }
        
          echo "<tr>
				<td align='center'>$no</td>
				<td align='left'>$data[tgl_penyewaan]</td>
				<td align='left'>$data[nama_pelanggan]</td>
				<td align='left'>".number_format($value)."</td>
				<td align='left'>$data[batas_waktu_dp]</td>
				
			</tr>";
    }
    
	// $q = $koneksi->query("SELECT *, COUNT(*) AS total FROM penyewaan 
	// WHERE status='Pembayaran DP' GROUP BY id_pelanggan, id_lapangan, tgl_penyewaan, status");
	//  $jml_data = $q->num_rows;
	//  $total = $dp * $jml_data;


    echo "<tr><td colspan='3' align='center'><b>Total</b></td><td><b>Rp. ".number_format($sum)."</td></tr>";

			
        myfooter();
        
	echo "<div class='footer'>
			<div>Jakarta, ".date('d-m-Y')."</div>
			<div style='margin-top:90px; margin-right:5px;'></div>
		</div>";
	echo "<div class='page' align='center'>Hal - ".$page."</div>";
	echo "</div>";
?>
<script type="text/javascript">
	window.print();
</script>