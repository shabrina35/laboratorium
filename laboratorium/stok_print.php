<?php 
include '../koneksi.php';
?>

 <!DOCTYPE html>
 <html>
     
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Stok</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 </head>
<?php 
$idstok = $_GET['id'];
$tanggalstok = $_GET['tgl'];
?>
 <body>
<!--<table width="1000" border="0" align="center">
  <tr>
    <td width="159"><span class="style1"><img src="../logo.png" width="90" height="80" /></span></td>
    <td width="661"><div align="center"><span class="style1">LABORATORIUM KLINIK DIAGNOSTIC</span><br/>
      <strong>Jl. A. Yani No. 177 Caruban Telp. (0351) 386228</strong><br/>
    Penanggung Jawab : dr. FELLA AVESIENA SUWARDI, Sp.Pk</div></td>
    <td width="166">&nbsp;</td>
  </tr>
</table>
<hr align="center" width="1000" size="6" color="green"/>-->


<center><h4><b>LAPORAN STOK</b></h4></center>


 		<div class="row">
 			<div class="col-lg-4">
 				<table border="0">
 				    <tr>
                      <th width="200">TANGGAL</th>
                      <th width="50">:</th>
                      <td width="500"><?php echo date('d-M-Y', strtotime($tanggalstok)); ?></td>
                    </tr>
 				</table>
 			</div>
 		</div>
</P>
 		<div class="table-responsive">
 			<table class="table1" border=1>
 				<thead>
 				    <tr>
                      <th class="th1" width="1%">NO</th>
                      <th class="th1 text-center">NAMA BAHAN</th>
                      <th class="th1 text-center">SPESIFIKASI BAHAN</th>
                      <th class="th1 text-center">QTY MASUK</th>
                      <th class="th1 text-center">QTY KELUAR</th>
                      <th class="th1 text-center">QTY AKHIR</th>
                    </tr>
 				</thead>
 				<tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM stok_detail WHERE id_stok='$idstok' order by stokdetail_id ASC");
                    while($d = mysqli_fetch_array($data)){
                        $datamasuk = $d['masuk'];
                        $datakeluar = $d['keluar'];
                        $dataawal = $d['awal'];
                        $jumlah1 = $dataawal + $datamasuk;
                        $dataakhir = $jumlah1 - $datakeluar;
                      ?>				    
                      <tr>
                        <td class="td1 text-center"><?php echo $no++; ?></td>
                        <td class=td1><?php echo $d['stok_bahan']; ?></td>
                        <td class="td1 text-center"><?php echo $d['stok_satuan']; ?></td>
                        <td class="td1 text-center"><?php echo $d['masuk']; ?></td>
                        <td class="td1 text-center"><?php echo $dataakhir; ?></td>
                        <td class="td1 text-center"><?php echo $d['keluar']; ?></td>
                      </tr>
<?php } ?>
                    
                  </tbody>
 			</table>


 		</div>
 </body>
 </html>

<style type="text/css">
body {
	background-size: 18%;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-repeat: no-repeat;
	background-position: center;
}
.table1, .td1, .th1{
    font-family: sans-serif;
    border-collapse:collapse;
    font-size: 16px;
    border: 1px solid black;
}
.table2{
    font-family: sans-serif;
    border-collapse:collapse;
    font-size: 16px;
}
th, td {
    padding: 3px;
     
}
</style>









<style type="text/css">
.style1 {
	font-size: 20px;
	font-weight: bold;
	color: green;
	text-align: center;
}
</style>

<script>
window.print();
$(document).ready(function(){
});
</script>

