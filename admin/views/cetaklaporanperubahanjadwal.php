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
	width: 800px;
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
font-size: 24pt;
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
// include 'class.crudlaporan.php';
// $perusahaan = new Perusahaan();
// $cetaklaporan = new Cetak_Laporan();
if (isset($_GET['tgl_1']) && isset($_GET['tgl_2']) && isset($_GET['lap'])) {
	$dat = $laporanperubahanjadwal->tampil_laporan_bulan_perubahanjadwal($koneksi,$_GET['tgl_1'],$_GET['tgl_2'],$_GET['lap']);
}else{
	$dat = $laporanperubahanjadwal->tampil_laporan_perubahanjadwal($koneksi);
}
// $per = $perusahaan->tampil_perusahaan($koneksi);
// $namaper = $per['nama_perusahaan'];
// $alamat = $per['alamat'];
// $pemilik = $per['pemilik'];
// $kota = $per['kota'];
$judul_H = "LAPORAN PERUBAHAN JADWAL <br>";
$tgl = date('d-m-Y');
// <p align='left'>Jl. Raya Kenangan Kota Kenangan</p>
function myheader2($judul_H){
echo  "<div class='header'>
					<h1 align='left'>Zazila Sport</h1>
					<br/><br/>
		  		<h2>".$judul_H."</h2>
		  	</div>
		<table class='grid'>
		<tr>
			<th width='7%'>No</th>
			<th>Pelanggan</th>
			<th>Tanggal Penyewaan</th>
			<th>Jam Berubah</th>
			<th>Lapangan</th>
			<th>Status Perubahan</th>
		</tr>";		
}
function myfooter2(){
	echo "</table>";
}
	echo "<div class='container' align='center'>";
	$page =1;
	// $gtotal =null;
	foreach ($dat as $index => $data) {
		$no = $index + 1;
		// $total = $data['harga_jual']*$data['jumlah'];
		// $gtotal = $gtotal + $total;
		if(($no % 25) == 1){
		   	if($index + 1 > 1){
		        myfooter2();
		        echo "<div class='pagebreak'>
				<div class='page' align='center'>Hal - $page</div>
				</div>";
				$page++;
		  	}
		   	myheader2($judul_H);
		}
		
		echo "<tr>
				<td align='center'>$no</td>
				<td align='center'>$data[nama_pelanggan]</td>
				<td align='left'>".date_format(date_create($data['tanggal_penyewaan']),'d-m-Y')."</td>
				<td align='center'>$data[jam_berubah]</td>
				<td align='center'>$data[nama_lapangan]</td>
				<td align='center'>$data[status_berubah]</td>
				
				</tr>";
	}
	
	myfooter2();
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